<?php
namespace App\Modules\PaymentMethod;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Lang;

class PaymentMethod extends Model{
	use Sortable;
    protected $table = 'payment_method';
    protected $fillable = ['name','description','type','is_active'];
	protected $primaryKey = "id";
    public $timestamps = false;
	public $sortable = ['name','description','type'];
	
	public static function lists() {
		$lists = self::where('is_active',1)->get();
		$list = array();
		if($lists) {
			foreach($lists as $key => $row) {
				$list[$row->id] = $row->name;
			}
		}
		return $list;
	} 
}