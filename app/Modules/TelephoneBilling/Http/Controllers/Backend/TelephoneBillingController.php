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

        if($get_data) {
            Cart::instance('line-form')->destroy(); //destroy first
            $get_data_details = TelephoneBillingDetail::where(['telephone_billing_id' => $get_data->id])->get();
            foreach($get_data_details as $key => $row) {
                Cart::instance('line-form')->add([
                    'id' => $row->period,
                    'name' => $row->phone_number,
                    'qty' => 1,
                    'price' => 1,
                    'options' => [
                        'abodemen' => $row->abodemen,
                        'japati' => $row->japati,
                        'mobile' => $row->mobile,
                        'local' => $row->local,
                        'sljj' => $row->sljj,
                        'sli_007' => $row->sli_007,
                        'telkom_global_017' => $row->telkom_global_017,
                        'surcharge' => $row->surcharge,
                        'surcharge_total' => $row->surcharge_total,
                        'ppn' => $row->ppn,
                        'ppn_total' => $row->ppn_total,
                        'subtotal' => $row->subtotal,
                    ]
                ]);
            }
        } else {
            Cart::instance('line-form')->destroy();
        }
		
		return Theme::view('telephone-billing::Backend.view',[
			'page_title' => Lang::get('app.telephone billing').' '.$get_data->number,
			'data' => $get_data,
			'details' => TelephoneBillingDetail::where(['telephone_billing_id' =>$id])->get(),
		]);
	}
	
	public function form($id = 0) {
		$id = $id ? Crypt::decrypt($id) : null;
		$get_data = TelephoneBilling::leftJoin('customers','customers.id','telephone_billings.customer_id')
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
		$rowId =  Input::has("id") ? Input::get("id") : null;
		$phone_number = Input::get('phone_number');
		$period = Input::get('period');
		$abodemen = Input::has('abodemen') ? Input::get('abodemen') : 0;
		$japati = Input::has('japati') ? Input::get('japati') : 0;
		$mobile = Input::has('mobile') ? Input::get('mobile') : 0;
		$local = Input::has('local') ? Input::get('local') : 0;
		$sli_007 = Input::has('sli_007') ? Input::get('sli_007') : 0;
		$sljj = Input::has('sljj') ? Input::get('sljj') : 0;
		$telkom_global_017 = Input::has('telkom_global_017') ? Input::get('telkom_global_017') : 0;
		$surcharge = Input::has('surcharge') ? Input::get('surcharge') : 0;
		$ppn = Input::has('ppn') ? Input::get('ppn') : 0;
		
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
		} else if($xperiod && !$rowId) {
			$params = array(
                'success' => false,
                'message' => [
					'period' => Lang::get('info.periode has already exists')
				]
            );
		} else {
			$total = $japati + $mobile + $local + $sljj + $sli_007 + $telkom_global_017;
			$surcharge_total = $surcharge !=  0 ? (($surcharge/100) * $total) : 0;
			$ppn_total = $ppn != 0 ? (($ppn/100) * ($abodemen + $total + $surcharge_total)) : 0;
			$sub_total  = $abodemen + $total + $surcharge_total + $ppn_total;
			
			//Add New Cart Item
			if(!$rowId) {
				$is_edit = false;
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
						'surcharge' => $surcharge,
                        'surcharge_total' => $surcharge_total,
						'ppn' => $ppn,
                        'ppn_total' => $ppn_total,
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
					
			} else {
				$is_edit = true;
				 // Will update the line
				Cart::instance('line-form')->update($rowId,[
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
                        'surcharge' => $surcharge,
                        'surcharge_total' => $surcharge_total,
                        'ppn' => $ppn,
                        'ppn_total' => $ppn_total,
						'subtotal' => $sub_total,
					]	
				]);
			}
			
			$params = array(
                'success' => true,
				'is_edit' => $is_edit,
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
                'surcharge' => number_format($surcharge,2),
				'surcharge_total' => number_format($surcharge_total,2),
                'ppn' => number_format($ppn_total,2),
				'ppn_total' => number_format($ppn_total,2),
				'subtotal' => number_format($sub_total,2),
			);
		}
		
		return Response::json($params);
	}
	
	public function view_line() {
		$rowId = Input::get('id');
		$row = Cart::instance('line-form')->get($rowId);
		if($row) {
			$params = [
				'success' => true,
				'rowId' => $row->rowId,
                'phone_number' => $row->name,
				'period' => $row->id,
				'abodemen' => $row->options->abodemen,
				'japati' => $row->options->japati,
				'mobile' => $row->options->mobile,
				'local' => $row->options->local,
				'sljj' => $row->options->sljj,
				'sli_007' => $row->options->sli_007,
				'telkom_global_017' => $row->options->telkom_global_017,
				'surcharge' => $row->options->surcharge,
                'surcharge_total' => $row->options->surcharge_total,
				'ppn' => $row->options->ppn,
                'ppn_total' => $row->options->ppn_total,
				'subtotal' => $row->options->sub_total,
			];
		} else {
			$params = [
				'success' => false,
				'false' => Lang::get('info.failed to view'),
			];
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
	
	
	public function do_update() {
		$id =  Input::has("id") ? Crypt::decrypt(Input::get("id")) : null;
		$customer_id = Input::get('customer_id');
		$payment_method_id = Input::get('payment_method_id');
		$payment_frequency = Input::get('payment_frequency');
		$print_date = preg_replace('!(\d+)/(\d+)/(\d+)!', '\3-\2-\1', Input::get('print_date'));
		$due_date = preg_replace('!(\d+)/(\d+)/(\d+)!', '\3-\2-\1', Input::get('due_date'));
		$service_period = Input::get('service_period');
		
		$field = array (
			'customer_id' => $customer_id,
			'payment_method_id' => $payment_method_id,
			'payment_frequency' => $payment_frequency,
			'print_date' => $print_date,
			'due_date' => $due_date,
			'service_period' => $service_period,
        );
		
		$rules = array (
			'customer_id' => "required",
			'payment_method_id' => "required",
			'payment_frequency' => "required",
			'print_date' => "required",
			'due_date' => "required",
			'service_period' => "required",
        );
		
		$validate = Validator::make($field,$rules);
		
		if($validate->fails()) {
			$params = array(
                'success' => false,
                'message' => $validate->getMessageBag()->toArray()
            );
		} else if(Cart::instance('line-form')->count() < 1) {
			$params = array(
                'success' => false,
                'message' => [
					'table_items' => Lang::get('info.no line item')
				]
            );		
		} else {
			//save / updated master
            $telephone_billing = new TelephoneBilling();
			if(!$id) {
				$telephone_billing->created_at = date("Y-m-d H:i:s");
				$telephone_billing->created_by = Auth::user()->id;
				$telephone_billing->number = TelephoneBilling::auto_number();
			} else {
				$telephone_billing =  $telephone_billing->where('id',$id)->first();
                $telephone_billing->updated_at = date("Y-m-d H:i:s");
				$telephone_billing->updated_by = Auth::user()->id;
			}
			
			$telephone_billing->customer_id = $customer_id;
			$telephone_billing->payment_method_id = $payment_method_id;
			$telephone_billing->payment_frequency = $payment_frequency;
			$telephone_billing->print_date = $print_date;
			$telephone_billing->due_date = $due_date;
			$telephone_billing->service_period = $service_period;
			$telephone_billing->abodemen = 0;
			$telephone_billing->japati = 0;
			$telephone_billing->mobile = 0;
			$telephone_billing->local = 0;
			$telephone_billing->sljj = 0;
			$telephone_billing->sli_007 = 0;
			$telephone_billing->telkom_global_017 = 0;
			$telephone_billing->surcharge = 0;
            $telephone_billing->surcharge_total = 0;
			$telephone_billing->ppn = 0;
            $telephone_billing->ppn_total = 0;
            $telephone_billing->total_bill = 0;
			$telephone_billing->save();
			
			//save / updated details
			//delete details
			$exe_update = TelephoneBillingDetail::where(['telephone_billing_id' => $telephone_billing->id])->delete();
			$total_item = 0;
			$total_abodemen = 0;
			$total_japati = 0;
			$total_mobile = 0;
			$total_local = 0;
			$total_sljj = 0;
			$total_sli_007 =0;
			$total_telkom_global_017 = 0;
            $total_surcharge = 0;
            $total_surcharge_total = 0;
            $total_ppn = 0;
            $total_ppn_total = 0;

            $total_subtotal = 0;
			foreach(Cart::instance('line-form')->content() as $row) {
				$telephone_billing_detail = new TelephoneBillingDetail();
				$telephone_billing_detail->telephone_billing_id = $telephone_billing->id;
				$telephone_billing_detail->phone_number = $row->name;
				$telephone_billing_detail->period = $row->id;
				$telephone_billing_detail->abodemen = $row->options->abodemen;
				$telephone_billing_detail->japati = $row->options->japati;
				$telephone_billing_detail->mobile = $row->options->mobile;
				$telephone_billing_detail->local = $row->options->local;
				$telephone_billing_detail->sljj = $row->options->sljj;
				$telephone_billing_detail->sli_007 = $row->options->sli_007;
				$telephone_billing_detail->telkom_global_017 = $row->options->telkom_global_017;
				$telephone_billing_detail->surcharge = $row->options->surcharge;
                $telephone_billing_detail->surcharge_total = $row->options->surcharge_total;
				$telephone_billing_detail->ppn = $row->options->ppn;
                $telephone_billing_detail->ppn_total = $row->options->ppn_total;
                $telephone_billing_detail->subtotal = $row->options->subtotal ? $row->options->subtotal : 0 ;
				$telephone_billing_detail->save();
				//variable total
                $total_item+=1;
				$total_abodemen+=$row->options->abodemen;
				$total_japati+=$row->options->japati;
				$total_mobile+=$row->options->mobile;
				$total_local+=$row->options->local;
				$total_sljj+= $row->options->sljj;
				$total_sli_007+=$row->options->sli_007;
				$total_telkom_global_017+=$row->options->telkom_global_017;
                $total_surcharge+= $row->options->surcharge;
                $total_surcharge_total+= $row->options->surcharge_total;
                $total_ppn+= $row->options->ppn;
                $total_ppn_total+= $row->options->ppn_total;
                $total_subtotal = $row->options->subtotal;
			}

			//clear cart
            $exe_destroy = Cart::instance('line-form')->destroy();
			
			//updated master 
			$exe_update = TelephoneBilling::where(['id' => $telephone_billing->id])->update([
				'abodemen' => $total_abodemen,
				'japati' => $total_japati,
				'mobile' => $total_mobile,
				'local' => $total_local,
				'sljj' => $total_sljj,
				'sli_007' => $total_sli_007,
				'telkom_global_017' => $total_telkom_global_017,
                'surcharge' => ($total_surcharge > 0 ? ($total_surcharge / $total_item) : 0),
                'surcharge_total' => $total_surcharge_total,
                'ppn' => ($total_ppn > 0 ? ($total_ppn / $total_item) : 0),
                'ppn_total' => $total_ppn_total,
                'total_bill' => $total_subtotal,
			]);

            $params = array(
                'success' => true,
                'message' => Lang::get('info.update successfully'),
                'redirect' => url('telephone-billing/view/'.Crypt::encrypt($telephone_billing->id)),
            );
			
		}
		
		return Response::json($params);
		
	}

    public function do_delete(TelephoneBilling $telephoneBilling,TelephoneBillingDetail $telephoneBillingDetail) {
        $id = Crypt::decrypt(Input::get("id"));
        $is_exists = $telephoneBilling->select(['id'])->where('id',$id)->first();
        if($is_exists && $id != 1) {
            /** Batch Delete **/
            $telephoneBillingDetail->where(['telephone_billing_id' => $id])->delete();
            $telephoneBilling->where(['id' => $id])->delete();
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

    public function get_customer(TelephoneBilling $telephoneBilling) {
        $id = Input::has('id') ? Crypt::decrypt(Input::get("id")) : 0;
        $data = $telephoneBilling->join('customers','customers.id','=','telephone_billings.customer_id')
            ->selectRaw("customers.id,CONCAT(customers.identity_number,' ',customers.name) as name")->where('telephone_billings.id',$id)->first();

        $lists = array();
        if($data) {
            $lists['key']['id'] = $data->id;
            $lists['key']['name'] = $data->name;
        }

        return Response::json($lists);
    }

}
