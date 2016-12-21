<?php
namespace App\Modules\Customer\Http\Controllers\Backend;

use Illuminate\Routing\Controller;
use App\Modules\Customer\Customer;
use Config;
use Crypt;
use Lang;
use Request;
use Theme;

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
		$get_data = Customer::find($id);
		return Theme::view('customer::Backend.view',[
			'page_title' => Lang::get('app.customer').' '.$get_data->name,
			'data' => $get_data,
		]);
	}
	
	public function form($id) {
		$id = $id ? Crypt::decrypt($id) : 0;
		$get_data = Customer::find($id);
		return Theme::view('customer::Backend.view',[
			'page_title' => Lang::get('app.customer').' '.($get_data ? $get_data->name : ''),
			'data' => $get_data,
		]);
	}
}