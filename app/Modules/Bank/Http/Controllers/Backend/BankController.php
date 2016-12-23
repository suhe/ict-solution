<?php
namespace App\Modules\Bank\Http\Controllers\Backend;

use Illuminate\Routing\Controller;
use App\Modules\Bank\Bank;
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

class BankController extends Controller {
	public function index(Bank $bank) {
		return Theme::view('bank::Backend.index',[
			'page_title' => Lang::get('app.bank'),
			'banks' => $bank
				->leftJoin('countries','countries.id','=','banks.country_id')
				->selectRaw("banks.*,countries.name as country")
				->whereRaw("CONCAT(banks.name,' ',countries.name) LIKE '%".Request::get("query")."%'")
				->sortable(['name' => 'asc'])
				->paginate(Config::get('site.limit_pagination')),
			
		]);
	}
	
	public function view($id) {
		$id = Crypt::decrypt($id);
		$get_data = Bank::leftJoin('countries','countries.id','=','banks.country_id')
		->selectRaw("banks.*,countries.name as country")
		->where('banks.id',$id)->first();
		return Theme::view('bank::Backend.view',[
			'page_title' => Lang::get('app.bank').' '.$get_data->name,
			'data' => $get_data,
			
		]);
	}
	
	public function do_publish($id,Bank $bank) {
		$id = Crypt::decrypt($id);
		$bank = $bank->find($id);
		if($bank) {
			if($bank->is_active == 1) 
				$active = 0;
			else
				$active = 1;
			//update bank
			$bank->is_active = $active;
			$bank->save();	
		}
		return Redirect::back();
	}
	
	public function form($id = 0) {
		$id = $id ? Crypt::decrypt($id) : 0;
		$get_data = Bank::find($id);
		return Theme::view('bank::Backend.form',[
			'page_title' => Lang::get('app.bank').' '.($get_data ? $get_data->name : ''),
			'data' => $get_data,
		]);
	}
	
	public function do_update() {
		$bank_id =  Input::has("id") ? Crypt::decrypt(Input::get("id")) : null;
		$name = Input::get('name');
		$country_id = Input::get('country_id');
		$description = Input::get('description');
		
        $field = array (
			'name' => $name,
			'country_id' => $country_id,
			'description' => $description,
        );

        $rules = array (
            'name' => (!$bank_id ? "required|unique:banks,name" : "required|unique:banks,name,$bank_id"),
			'country_id' => "required|min:1",
			'description' => "required|min:5",
		);

        $validate = Validator::make($field,$rules);

        if($validate->fails()) {
            $params = array(
                'success' => false,
                'message' => $validate->getMessageBag()->toArray()
            );
		} else {
			$bank = new Bank();
			if(!empty($bank_id)) {
				//update bank
				$bank = $bank->find($bank_id);
				$bank->updated_at = date("Y-m-d H:i:s");
				$bank->updated_by = Auth::user()->id;
				$message = Lang::get('info.update successfully');
			} else {
				//insert new bank
				$bank->created_at = date("Y-m-d H:i:s");
				$bank->created_by = Auth::user()->id;
				$message =  Lang::get('info.insert successfully');
			}
			
			$bank->name = $name;
			$bank->description = $description;
			$bank->country_id = $country_id;
			$bank->save();
			
			
			//params json
			$params ['success'] =  true;
			$params ['redirect'] = url('/bank/view/'.Crypt::encrypt($bank->id));
			$params ['message'] =  $message;			
		}
		//return response
        return Response::json($params);
	}
	
	public function do_delete(Bank $bank) {
        $id = Crypt::decrypt(Input::get("id"));
        $is_exists = $bank->select(['id'])->where('id',$id)->first();
        if($is_exists && $id != 1) {
			/** Batch Delete **/
            $bank->where(['id' => $id])->delete();
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
	
}