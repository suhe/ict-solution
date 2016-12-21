<?php
namespace App\Modules\CustomerGroup\Http\Controllers\Backend;

use Illuminate\Routing\Controller;
use App\Modules\CustomerGroup\CustomerGroup;
use Input;
use Lang;
use Response;


class CustomerGroupController extends Controller {
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