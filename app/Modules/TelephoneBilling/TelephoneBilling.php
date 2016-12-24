<?php
namespace App\Modules\TelephoneBilling;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Config;
use Lang;

class TelephoneBilling extends Model{
	use Sortable;
    protected $table = 'telephone_billings';
    protected $fillable = ['number','is_active'];
	protected $primaryKey = "id";
    public $timestamps = false;
	public $sortable = ['number',];

    public static function auto_number(){
        $prefix_number = Config::get('site.invoice_billing_telephone_number');
        $starting_number = Config::get('site.invoice_billing_telephone_number_start');
        $count = self::count();
        $starting_number = $count +  $starting_number;
        $starting_number = digit_format($starting_number);
        $month = date('m');
        $year = date('Y');
        return $invoice_number = $prefix_number.'/'.romawi_format($month).'/'.$year.'/'.$starting_number;
    }

}