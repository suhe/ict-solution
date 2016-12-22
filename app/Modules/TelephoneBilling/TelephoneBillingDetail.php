<?php
namespace App\Modules\TelephoneBilling;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Lang;

class TelephoneBillingDetail extends Model{
	use Sortable;
    protected $table = 'telephone_billing_details';
    protected $fillable = ['phone_number'];
	protected $primaryKey = "id";
    public $timestamps = false;
	public $sortable = ['phone_number'];
	
}