<?php
namespace App\Modules\TelephoneBilling\Http\Controllers\Backend;
use Illuminate\Routing\Controller;
use App\Modules\Customer\Customer;
use App\Modules\TelephoneBilling\TelephoneBilling;
use App\Modules\TelephoneBilling\TelephoneBillingDetail;
use Auth;
use Cart;
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
		$sljj = Input::get('sljj');
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
		$xperiod = "";
		foreach(Cart::instance('line-form')->content() as $row) {
			if($row->id == $period) {
				$xperiod = $period;
				break;					
			}
		}
		
		if($validate->fails()) {
			$params = array(
                'success' => false,
                'message' => $validate->getMessageBag()->toArray()
            );
		} else if($xperiod) {
			$params = array(
                'success' => false,
                'message' => [
					'period' => Lang::get('info.periode has already exists')
				]
            );
		} else {
			$total = $japati + $mobile + $local + $sljj + $sli_007 + $telkom_global_017;
			$surcharge_total = ($surcharge/100) * $total;
			$ppn_total = ($ppn/100) * ($abodemen + $total + $surcharge_total);
			$sub_total  = $abodemen + $total + $surcharge_total + $ppn_total;
			
			Cart::instance('line-form')->add([
				'id' => $period,
				'name' => $phone_number,
				'qty' => 1,
				'price' => 1,
				'options' => [
					'abodemen' => $abodemen,
					'japati' => $japati,
					'mobile' => $mobile,
					'local' => $local,
					'sljj' => $sljj,
					'sli_007' => $sli_007,
					'telkom_global_017' => $telkom_global_017,
					'surcharge' => $surcharge_total,
					'ppn' => $ppn_total,
					'subtotal' => $sub_total,
				]	
			]);
			
			$rowId = "";
			foreach(Cart::instance('line-form')->content() as $row) {
				if($row->id == $period) {
					$rowId = $row->rowId;
					break;					
				}
			}
			
			$params = array(
                'success' => true,
				'rowId' => $rowId,
                'phone_number' => $phone_number,
				'period' => $period,
				'abodemen' => number_format($abodemen,2),
				'japati' => number_format($japati,2),
				'mobile' => number_format($mobile,2),
				'local' => number_format($local,2),
				'sljj' => number_format($sljj,2),
				'sli_007' => number_format($sli_007,2),
				'telkom_global_017' => number_format($telkom_global_017,2),
				'total' => number_format($total,2),
				'surcharge' => number_format($surcharge_total,2),
				'ppn' => number_format($ppn_total,2),
				'subtotal' => number_format($sub_total,2),
			);
		}
		
		return Response::json($params);
	}
	
	public function do_delete_line() {
		$rowId = Input::get('id');
		$exe_delete = Cart::instance('line-form')->remove($rowId);
		$params = [
			'success' => true,
			'false' => Lang::get('info.delete successfully'),
		];
		return Response::json($params);
	}
	
}
