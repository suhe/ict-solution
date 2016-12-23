<?php
namespace App\Modules\TelephoneBilling\Http\Controllers\Backend;
use Illuminate\Routing\Controller;
use App\Modules\Customer\Customer;
use App\Modules\TelephoneBilling\TelephoneBilling;
use App\Modules\TelephoneBilling\TelephoneBillingDetail;
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

class TelephoneBillingController extends Controller {
	public function index(TelephoneBilling $billing) {
		return Theme::view('telephone-billing::Backend.index',[
			'page_title' => Lang::get('app.telephone billing'),
			'telephone_billings' => $billing
				->join('customers','customers.id','=','telephone_billings.customer_id')
				->selectRaw("telephone_billings.*,customers.name as customer_name,DATE_FORMAT(print_date,'%d/%m/%Y') as print_date,DATE_FORMAT(due_date,'%d/%m/%Y') as due_date")
				->whereRaw("CONCAT(number) LIKE '%".Request::get("query")."%'")
				->sortable(['number' => 'desc'])
				->paginate(Config::get('site.limit_pagination')),
		]);
	}
	
	public function view($id) {
		$id = Crypt::decrypt($id);
		$get_data = TelephoneBilling::join('customers','customers.id','telephone_billings.customer_id')
		->leftJoin('cities','cities.id','customers.city_id')
		->leftJoin('payment_method','payment_method.id','telephone_billings.payment_method_id')
		->selectRaw("telephone_billings.*,customers.name as customer_name,customers.address as customer_address,cities.name as customer_city,customers.zip_code as customer_zip_code,contact_person,contact_position,customers.identity_number as customer_id")
		->selectRaw("payment_method.name as payment_method")
		->where('telephone_billings.id',$id)
		->first();
		
		return Theme::view('telephone-billing::Backend.view',[
			'page_title' => Lang::get('app.telephone billing').' '.$get_data->number,
			'data' => $get_data,
			'details' => TelephoneBillingDetail::where(['telephone_billing_id' =>$id])->get(),
		]);
	}
	
	public function form($id = 0) {
		$id = $id ? Crypt::decrypt($id) : null;
		$get_data = TelephoneBilling::join('customers','customers.id','telephone_billings.customer_id')
		->leftJoin('cities','cities.id','customers.city_id')
		->leftJoin('payment_method','payment_method.id','telephone_billings.payment_method_id')
		->selectRaw("telephone_billings.*,customers.name as customer_name,customers.address as customer_address,cities.name as customer_city,customers.zip_code as customer_zip_code,contact_person,contact_position,customers.identity_number as customer_id")
		->selectRaw("payment_method.name as payment_method")
		->where('telephone_billings.id',$id)
		->first();
		
		return Theme::view('telephone-billing::Backend.form',[
			'page_title' => Lang::get('app.telephone billing').' '.($get_data ? $get_data->number : null),
			'data' => $get_data,
			'details' => TelephoneBillingDetail::where(['telephone_billing_id' =>$id])->get(),
		]);
	}
	
	public function do_update_line() {
		$telephone_billing_id =  Input::has("id") ? Crypt::decrypt(Input::get("id")) : null;
		$phone_number = Input::get('phone_number');
		$period = Input::get('period');
		$abodemen = Input::get('abodemen');
		$japati = Input::get('japati');
		$mobile = Input::get('mobile');
		$local = Input::get('local');
		$sli_007 = Input::get('sli_007');
		$telkom_global_017 = Input::get('telkom_global_017');
		$surcharge = Input::get('surcharge');
		$ppn = Input::get('ppn');
		
		$field = array (
			'phone_number' => $phone_number,
			'period' => $period,
			'abodemen' => $abodemen,
			'japati' => $japati,
			'mobile' => $mobile,
			'local' => $local,
			'sli_007' => $sli_007,
			'telkom_global_017' => $telkom_global_017,
			'surcharge' => $surcharge,
			'ppn' => $ppn,
        );
		
		$rules = array (
			'phone_number' => "required",
			'period' => "required",
			'abodemen' => "required",
			'japati' => "required",
			'mobile' => "required",
			'local' => "required",
			'sli_007' => "required",
			'telkom_global_017' => "required",
			'surcharge' => "required",
			'ppn' => "required",
        );
		
		$validate = Validator::make($field,$rules);
		if($validate->fails()) {
			$params = array(
                'success' => false,
                'message' => $validate->getMessageBag()->toArray()
            );
		} else {
			$params = array(
                'success' => true,
                'phone_number' => $phone_number,
				'period' => $period,
			);
		}
		
		return Response::json($params);

	}
}
