<?php
namespace App\Modules\Customer\Http\Controllers\Backend;

use Illuminate\Routing\Controller;
use App\Modules\City\City;
use App\Modules\Customer\Customer;
use Auth;
use Config;
use Crypt;
use Input;
use Lang;
use Request;
use Redirect;
use Response;
use Theme;
use Validator;

class CustomerController extends Controller {
	public function index(Customer $customer) {
		return Theme::view('customer::Backend.index',[
			'page_title' => Lang::get('app.customer'),
			'customers' => $customer
				->whereRaw("name LIKE '%".Request::get("query")."%'")
				->sortable(['identity_number' => 'asc'])
				->paginate(Config::get('site.limit_pagination')),
			
		]);
	}
	
	public function view($id) {
		$id = Crypt::decrypt($id);
		$get_data = Customer::leftJoin('cities','cities.id','customers.city_id')
		->leftJoin('customer_groups','customer_groups.id','customers.customer_group_id')
		->selectRaw("customers.*,cities.name as city,customer_groups.name as customer_group")
		->where('customers.id',$id)
		->first();
		return Theme::view('customer::Backend.view',[
			'page_title' => Lang::get('app.customer').' '.$get_data->name,
			'data' => $get_data,
		]);
	}
	
	public function do_publish($id,Customer $customer) {
		$id = Crypt::decrypt($id);
		$customer = $customer->find($id);
		if($customer) {
			if($customer->is_active == 1) 
				$active = 0;
			else
				$active = 1;
			//update customer
			$customer->is_active = $active;
			$customer->save();	
		}
		return Redirect::back();
	}
	
	public function form($id = 0) {
		$id = $id ? Crypt::decrypt($id) : 0;
		$get_data = Customer::find($id);
		return Theme::view('customer::Backend.form',[
			'page_title' => Lang::get('app.customer').' '.($get_data ? $get_data->name : ''),
			'data' => $get_data,
		]);
	}
	
	public function do_update() {
		$customer_id =  Input::has("id") ? Crypt::decrypt(Input::get("id")) : null;
		$identity_number = Input::get('identity_number');
		$name = Input::get('name');
        $building_address = Input::get('building_address');
		$address = Input::get('address');
		$city_id = Input::get('city_id');
		$zip_code = Input::get('zip_code');
		$customer_group_id = Input::get('customer_group_id');
		$contact_person = Input::get('contact_person');
		$phone_number = Input::get('phone_number');
		$contact_position = Input::get('contact_position');
		
        $field = array (
			'identity_number' => $identity_number,
			'name' => $name,
			'address' => $address,
			'city_id' => $city_id,
			'zip_code' => $zip_code,
			'customer_group_id' => $customer_group_id,
			'contact_person' => $contact_person,
			'phone_number' => $phone_number,
			'contact_position' => $contact_position,
        );

        $rules = array (
            'identity_number' => "required",
			'name' => "required",
			'address' => "required",
			'city_id' => "required",
			'zip_code' => "required",
			'customer_group_id' => "required",
			'contact_person' => "required",
			'phone_number' => "required",
			'contact_position' => "required",
        );

        $validate = Validator::make($field,$rules);

        if($validate->fails()) {
            $params = array(
                'success' => false,
                'message' => $validate->getMessageBag()->toArray()
            );
		} else {
			$customer = new Customer();
			if(!empty($customer_id)) {
				//update Customer
				$customer = $customer->find($customer_id);
				$customer->updated_at = date("Y-m-d H:i:s");
				$customer->updated_by = Auth::user()->id;
				$message = Lang::get('info.update successfully');
			} else {
				//insert new Customer
				$customer->created_at = date("Y-m-d H:i:s");
				$customer->created_by = Auth::user()->id;
				$message =  Lang::get('info.insert successfully');
			}
			
			$customer->identity_number = $identity_number;
			$customer->customer_group_id  = $customer_group_id;
			$customer->name  = $name;
            $customer->building_address  = $building_address;
			$customer->address  = $address;
			$customer->city_id  = $city_id;
			$customer->zip_code  = $zip_code;
			$customer->contact_person = $contact_person;
			$customer->phone_number = $phone_number;
			$customer->contact_position = $contact_position;
			$customer->save();
			
			//params json
			$params ['success'] =  true;
			$params ['redirect'] = url('/customer/view/'.Crypt::encrypt($customer->id));
			$params ['message'] =  $message;			
		}

        return Response::json($params);
	}
	
	public function do_delete(Customer $customer) {
        $id = Crypt::decrypt(Input::get("id"));
        $is_exists = $customer->select(['id'])->where('id',$id)->first();
        if($is_exists) {
            $customer->where(['id' => $id])->delete();
            $params ['id'] =  $is_exists->id;
            $params ['success'] =  true;
            $params ['message'] =  Lang::get('info.delete successfully');
        }
        return Response::json($params);
    }
	
	public function get_city(Customer $customer) {
		$id = Input::has('id') ? Crypt::decrypt(Input::get("id")) : 0;
		$data = $customer->join('cities','cities.id','=','customers.city_id')
		->select(['cities.id','cities.name'])->where('customers.id',$id)->first();
		
		$lists = array();
		if($data) {
			$lists['key']['id'] = $data->id;
			$lists['key']['name'] = $data->name;
		}
		
		return Response::json($lists);
	}
	
	public function get_customer_group(Customer $customer) {
		$id = Input::has('id') ? Crypt::decrypt(Input::get("id")) : 0;
		$data = $customer->join('customer_groups','customer_groups.id','=','customers.customer_group_id')
		->select(['customer_groups.id','customer_groups.name'])->where('customers.id',$id)->first();
		
		$lists = array();
		if($data) {
			$lists['key']['id'] = $data->id;
			$lists['key']['name'] = $data->name;
		}
		
		return Response::json($lists);
	}
	
	public function lists(Customer $customer) {
		$term = Input::get('term');
		if(Input::has('term')) {
			$lists = $customer->whereRaw("CONCAT(name,' ',identity_number) like '%".$term>".%'")->selectRaw("id,CONCAT(identity_number,' ',name) as name")->get();
			return Response::json($lists);
		} else {
			return Response::json($lists = array());
		}	
	}
	
	public function view_json() {
		$id = Input::get('id');
		
		$get_data = Customer::leftJoin('cities','cities.id','customers.city_id')
		->leftJoin('customer_groups','customer_groups.id','customers.customer_group_id')
		->selectRaw("customers.*,cities.name as city,customer_groups.name as customer_group")
		->where('customers.id',$id)
		->first();
		
		if($get_data) {
			$params ['success'] =  true;
			$params ['customer_name'] =  $get_data->name;
			$params ['customer_address'] =  $get_data->address;
			$params ['customer_city'] =  $get_data->city;
			$params ['customer_zip_code'] =  $get_data->zip_code;
			$params ['customer_contact_person'] =  $get_data->contact_person;
			$params ['customer_contact_position'] =  $get_data->contact_position;
		} else {
			$params ['success'] =  false;
		}
		
		return Response::json($params);
	}
	
}