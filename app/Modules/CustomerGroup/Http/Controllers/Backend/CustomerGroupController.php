<?php
namespace App\Modules\CustomerGroup\Http\Controllers\Backend;

use Illuminate\Routing\Controller;
use App\Modules\CustomerGroup\CustomerGroup;
use Auth;
use Config;
use Crypt;
use Input;
use Lang;
use Redirect;
use Request;
use Response;
use Theme;
use Validator;

class CustomerGroupController extends Controller {
	public function index(CustomerGroup $customer_group) {
		return Theme::view('customer-group::Backend.index',[
			'page_title' => Lang::get('app.customer group'),
			'customer_groups' => $customer_group
				->whereRaw("name LIKE '%".Request::get("query")."%'")
				->sortable(['name' => 'asc'])
				->paginate(Config::get('site.limit_pagination')),
		]);
	}
	
	public function view($id) {
		$id = Crypt::decrypt($id);
		$get_data = CustomerGroup::where('customer_groups.id',$id)
		->first();
		
		return Theme::view('customer-group::Backend.view',[
			'page_title' => Lang::get('app.customer group').' '.$get_data->name,
			'data' => $get_data,
		]);
	}
	
	public function do_publish($id,CustomerGroup $customer_group) {
		$id = Crypt::decrypt($id);
		$customer_group = $customer_group->find($id);
		if($customer_group) {
			if($customer_group->is_active == 1) 
				$active = 0;
			else
				$active = 1;
			//update customer
			$customer_group->is_active = $active;
			$customer_group->save();	
		}
		return Redirect::back();
	}
	
	public function form($id = 0) {
		$id = $id ? Crypt::decrypt($id) : 0;
		$get_data = CustomerGroup::find($id);
		return Theme::view('customer-group::Backend.form',[
			'page_title' => Lang::get('app.customer group').' '.($get_data ? $get_data->name : ''),
			'data' => $get_data,
		]);
	}
	
	public function do_update() {
		$customer_group_id =  Input::has("id") ? Crypt::decrypt(Input::get("id")) : null;
		$name = Input::get('name');
		
        $field = array (
			'name' => $name,
        );

        $rules = array (
			'name' => "required",
        );

        $validate = Validator::make($field,$rules);

        if($validate->fails()) {
            $params = array(
                'success' => false,
                'message' => $validate->getMessageBag()->toArray()
            );
		} else {
			$customer_group = new CustomerGroup();
			if(!empty($customer_group_id)) {
				//update Customer
				$customer_group = $customer_group->find($customer_group_id);
				$customer_group->updated_at = date("Y-m-d H:i:s");
				$customer_group->updated_by = Auth::user()->id;
				$message = Lang::get('info.update successfully');
			} else {
				//insert new Customer
				$customer_group->created_at = date("Y-m-d H:i:s");
				$customer_group->created_by = Auth::user()->id;
				$message =  Lang::get('info.insert successfully');
			}
		
			$customer_group->name  = $name;
			$customer_group->save();
			
			//params json
			$params ['success'] =  true;
			$params ['redirect'] = url('/customer-group/view/'.Crypt::encrypt($customer_group->id));
			$params ['message'] =  $message;			
		}

        return Response::json($params);
	}
	
	public function do_delete(CustomerGroup $customer_group) {
        $id = Crypt::decrypt(Input::get("id"));
        $is_exists = $customer_group->select(['id'])->where('id',$id)->first();
        if($is_exists) {
            $customer_group->where(['id' => $id])->delete();
            $params ['id'] =  $is_exists->id;
            $params ['success'] =  true;
            $params ['message'] =  Lang::get('info.delete successfully');
        }
        return Response::json($params);
    }
	
	public function lists(CustomerGroup $customer_group) {
		$term = Input::get('term');
		if(Input::has('term')) {
			$lists = $customer_group->where('name', 'like', '%'.$term .'%')->select(['id','name'])->get();
			return Response::json($lists);
		} else {
			return Response::json($lists = array());
		}	
	}
}