<?php
namespace App\Modules\AccountBank\Http\Controllers\Backend;

use Illuminate\Routing\Controller;
use App\Modules\AccountBank\AccountBank;
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

class AccountBankController extends Controller {
	public function index(AccountBank $account_bank) {
		return Theme::view('account-bank::Backend.index',[
			'page_title' => Lang::get('app.account bank'),
			'account_banks' => $account_bank
				->leftJoin('banks','banks.id','=','bank_accounts.bank_id')
				->selectRaw("bank_accounts.*,banks.name as bank")
				->whereRaw("CONCAT(banks.name,' ',bank_accounts.branch,' ',bank_accounts.account_no,' ',bank_accounts.account_name) LIKE '%".Request::get("query")."%'")
				->sortable(['account_name' => 'asc'])
				->paginate(Config::get('site.limit_pagination')),
		]);
	}
	
	public function view($id) {
		$id = Crypt::decrypt($id);
		$get_data = AccountBank::leftJoin('banks','banks.id','=','bank_accounts.bank_id')
		->selectRaw("bank_accounts.*,banks.name as bank")
		->where('bank_accounts.id',$id)->first();
		return Theme::view('account-bank::Backend.view',[
			'page_title' => Lang::get('app.account bank').' '.$get_data->account_no,
			'data' => $get_data,
			
		]);
	}
	
	public function do_publish($id,AccountBank $account_bank) {
		$id = Crypt::decrypt($id);
		$account_bank = $account_bank->find($id);
		if($account_bank) {
			if($account_bank->is_active == 1) 
				$active = 0;
			else
				$active = 1;
			//update account bank
			$account_bank->is_active = $active;
			$account_bank->save();	
		}
		return Redirect::back();
	}
	
	public function form($id = 0) {
		$id = $id ? Crypt::decrypt($id) : 0;
		$get_data = AccountBank::find($id);
		return Theme::view('account-bank::Backend.form',[
			'page_title' => Lang::get('app.account bank').' '.($get_data ? $get_data->account_no : ''),
			'data' => $get_data,
		]);
	}
	
	public function do_update() {
		$account_bank_id =  Input::has("id") ? Crypt::decrypt(Input::get("id")) : null;
		$account_no = Input::get('account_no');
		$account_name = Input::get('account_name');
		$bank_id = Input::get('bank_id');
		$branch = Input::get('branch');
		$company_id = Auth::user()->company_id;
		
        $field = array (
			'account_no' => $account_no,
			'account_name' => $account_name,
			'bank_id' => $bank_id,
        );

        $rules = array (
            'account_no' => (!$account_bank_id ? "required|unique:bank_accounts,account_no" : "required|unique:bank_accounts,account_no,$account_bank_id"),
			'account_name' => "required|min:3",
			'bank_id' => "required|min:1",
		);

        $validate = Validator::make($field,$rules);

        if($validate->fails()) {
            $params = array(
                'success' => false,
                'message' => $validate->getMessageBag()->toArray()
            );
		} else {
			$account_bank = new AccountBank();
			if(!empty($account_bank_id)) {
				//update account_bank
				$account_bank = $account_bank->find($account_bank_id);
				$account_bank->updated_at = date("Y-m-d H:i:s");
				$account_bank->updated_by = Auth::user()->id;
				$message = Lang::get('info.update successfully');
			} else {
				//insert new account_bank
				$account_bank->created_at = date("Y-m-d H:i:s");
				$account_bank->created_by = Auth::user()->id;
				$message =  Lang::get('info.insert successfully');
			}
			
			$account_bank->account_no = $account_no;
			$account_bank->account_name = $account_name;
			$account_bank->branch = $branch;
			$account_bank->bank_id = $bank_id;
			$account_bank->save();
			
			
			//params json
			$params ['success'] =  true;
			$params ['redirect'] = url('/account-bank/view/'.Crypt::encrypt($account_bank->id));
			$params ['message'] =  $message;			
		}
		//return response
        return Response::json($params);
	}
	
	public function do_delete(AccountBank $account_bank) {
        $id = Crypt::decrypt(Input::get("id"));
        $is_exists = $account_bank->select(['id'])->where('id',$id)->first();
        if($is_exists && $id != 1) {
			/** Batch Delete **/
            $account_bank->where(['id' => $id])->delete();
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