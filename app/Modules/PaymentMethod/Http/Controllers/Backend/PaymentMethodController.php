<?php
namespace App\Modules\PaymentMethod\Http\Controllers\Backend;

use Illuminate\Routing\Controller;
use App\Modules\PaymentMethod\PaymentMethod;
use Auth;
use Config;
use Crypt;
use Input;
use Lang;
use Module;
use Request;
use Redirect;
use Response;
use Theme;
use Validator;

class PaymentMethodController extends Controller {
	public function index(PaymentMethod $payment_method) {
		return Theme::view('payment-method::Backend.index',[
			'page_title' => Lang::get('app.payment method'),
			'payment_method' => $payment_method
				->whereRaw("CONCAT(name) LIKE '%".Request::get("query")."%'")
				->sortable(['name' => 'asc'])
				->paginate(Config::get('site.limit_pagination')),
			
		]);
	}
	
	public function view($id) {
		$id = Crypt::decrypt($id);
		$get_data = PaymentMethod::where('id',$id)->first();
		return Theme::view('payment-method::Backend.view',[
			'page_title' => Lang::get('app.payment method').' '.$get_data->name,
			'data' => $get_data,
			
		]);
	}
	
	public function do_publish($id,PaymentMethod $payment_method) {
		$id = Crypt::decrypt($id);
		$payment_method = $payment_method->find($id);
		if($payment_method) {
			if($payment_method->is_active == 1) 
				$active = 0;
			else
				$active = 1;
			//update payment method
			$payment_method->is_active = $active;
			$payment_method->save();	
		}
		return Redirect::back();
	}
	
	public function form($id = 0) {
		$id = $id ? Crypt::decrypt($id) : 0;
		$get_data = PaymentMethod::find($id);
		return Theme::view('payment-method::Backend.form',[
			'page_title' => Lang::get('app.payment method').' '.($get_data ? $get_data->name : ''),
			'data' => $get_data,
		]);
	}
	
	public function do_update() {
		$payment_method_id =  Input::has("id") ? Crypt::decrypt(Input::get("id")) : null;
		$name = Input::get('name');
		$type = Input::get('type');
		$description = Input::get('description');
		
        $field = array (
			'name' => $name,
            'type' => $type,
			'description' => $description
        );

        $rules = array (
            'name' => (!$payment_method_id ? "required|unique:payment_method,name" : "required|unique:payment_method,name,$payment_method_id"),
			'type' => "required|min:3",
			'description' => "required|min:5",
		);

        $validate = Validator::make($field,$rules);

        if($validate->fails()) {
            $params = array(
                'success' => false,
                'message' => $validate->getMessageBag()->toArray()
            );
		} else {
			$payment_method = new PaymentMethod();
			if(!empty($payment_method_id)) {
				//update payment method
				$payment_method = $payment_method->find($payment_method_id);
				$payment_method->updated_at = date("Y-m-d H:i:s");
				$payment_method->updated_by = Auth::user()->id;
				$message = Lang::get('info.update successfully');
			} else {
				//insert new payment method
				$payment_method->created_at = date("Y-m-d H:i:s");
				$payment_method->created_by = Auth::user()->id;
				$message =  Lang::get('info.insert successfully');
			}
			
			$payment_method->name = $name;
			$payment_method->type = $type;
			$payment_method->description  = $description;
			$payment_method->save();
			
			
			//params json
			$params ['success'] =  true;
			$params ['redirect'] = url('/payment-method/view/'.Crypt::encrypt($payment_method->id));
			$params ['message'] =  $message;			
		}
		//return response
        return Response::json($params);
	}
	
	public function do_delete(PaymentMethod $payment_method) {
        $id = Crypt::decrypt(Input::get("id"));
        $is_exists = $payment_method->select(['id'])->where('id',$id)->first();
        if($is_exists && $id != 1) {
			/** Batch Delete **/
            $payment_method->where(['id' => $id])->delete();
			/** Batch Delete **/
            $params ['id'] =  $is_exists->id;
            $params ['success'] =  true;
            $params ['message'] =  Lang::get('info.delete successfully');
        } else {
			$params ['id'] =  1;
            $params ['success'] =  false;
            $params ['message'] =  Lang::get('info.delete failed');
		}
        return Response::json($params);
    }

    public function get_type() {
        $id = Input::get('id');
        $payment_method = PaymentMethod::select(['type'])->where('id',$id)->first();
        if($payment_method) {
            $params ['success'] =  true;
            $params ['type'] = $payment_method->type;
        } else {
            $params ['success'] =  false;
            $params ['type'] = "";
        }
        return Response::json($params);
    }
	
}