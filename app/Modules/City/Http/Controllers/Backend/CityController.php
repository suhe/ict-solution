<?php
namespace App\Modules\City\Http\Controllers\Backend;

use Illuminate\Routing\Controller;
use App\Modules\City\City;
use Input;
use Lang;
use Response;


class CityController extends Controller {
	public function lists(City $city) {
		$term = Input::get('term');
		if(Input::has('term')) {
			$lists = $city->where('name', 'like', '%'.$term .'%')->select(['id','name'])->get();
			return Response::json($lists);
		} else {
			return Response::json($lists = array());
		}	
	}
	
	
}