<?php
namespace App\Modules\TelephoneBilling;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Lang;

class TelephoneBillingPayment extends Model{
	use Sortable;
    protected $table = 'telephone_billing_payments';
    protected $fillable = ['date'];
	protected $primaryKey = "id";
    public $timestamps = false;
	public $sortable = ['date','payment_method_id','bank_account_id','total','description'];
	
}