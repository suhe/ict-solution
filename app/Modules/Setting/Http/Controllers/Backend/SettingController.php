<?php
namespace App\Modules\Setting\Http\Controllers\Backend;

use Illuminate\Routing\Controller;
use App\Modules\Company\Company;
use App\Modules\User\User;
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

class SettingController extends Controller {
	public function index(User $user) {
		return Theme::view('setting::Backend.setting',[
			'page_title' => Lang::get('app.setting'),
			'company' => $user->leftJoin('companies','companies.id','=','users.company_id')
				->selectRaw('companies.*')
				->find(Auth::user()->id),
		]);
	}
	
	public function do_update_company() {
		$company_id =  Auth::user()->company_id;
		$name = Input::get('name');
		$npwp = Input::get('npwp');
		$address_1 = Input::get('address_1');
		$address_2 = Input::get('address_2');
		$city_id = Input::get('city_id');
		$zip_code = Input::get('zip_code');
        $phone_number = Input::get('phone_number');
        $fax_number = Input::get('fax_number');
		
        $field = array (
			'name' => $name,
			'npwp' => $npwp,
			'address_1' => $address_1,
			'city_id' => $city_id,
			'zip_code' => $zip_code,
            'phone_number' => $phone_number,
            'fax_number' => $fax_number,
        );

        $rules = array (
            'name' => "required",
			'npwp' => "required",
			'address_1' => "required",
			'city_id' => "required",
			'zip_code' => "required",
            'phone_number' => "required",
            'fax_number' => "required",
        );

        $validate = Validator::make($field,$rules);

        if($validate->fails()) {
            $params = array(
                'success' => false,
                'message' => $validate->getMessageBag()->toArray()
            );
		} else {
			$company = new Company();
			$company = $company->find($company_id);
			$company->name  = $name;
			$company->npwp  = $npwp;
			$company->address_1  = $address_1;
			$company->address_2  = $address_2;
			$company->city_id  = $city_id;
			$company->zip_code = $zip_code;
            $company->phone_number  = $phone_number;
            $company->fax_number = $fax_number;
			$company->updated_at = date("Y-m-d H:i:s");
			$company->updated_by = Auth::user()->id;
			$company->save();
			
			//params json
			$params ['success'] =  true;
			$params ['message'] =  Lang::get('info.update successfully');				
		}

        return Response::json($params);
	}
	
	
	
	
}