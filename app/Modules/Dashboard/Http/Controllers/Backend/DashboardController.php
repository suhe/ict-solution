<?php
namespace App\Modules\Dashboard\Http\Controllers\Backend;

use App\Modules\Company\Company;
use App\Modules\TelephoneBilling\TelephoneBilling;
use Illuminate\Routing\Controller;
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

class DashboardController extends Controller {
    public function index()
    {
        return Theme::view('dashboard::Backend.index', [
            'page_title' => Lang::get('app.dashboard'),
            'company' => Company::leftJoin('cities','cities.id','=','companies.city_id')
                ->where(['companies.id' => Auth::user()->company_id])
                ->selectRaw("companies.*,cities.name as city")
                ->first(),
            'latest_billings' => TelephoneBilling::join('customers','customers.id','=','telephone_billings.customer_id')
                ->selectRaw("telephone_billings.number,customers.name as customer_name")
                ->limit(10)->get(),
        ]);
    }
}