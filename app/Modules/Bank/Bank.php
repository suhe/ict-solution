<?php
namespace App\Modules\Bank;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Lang;

class Bank extends Model{
	use Sortable;
    protected $table = 'banks';
    protected $fillable = ['name','country_id','description','is_active'];
	protected $primaryKey = "id";
    public $timestamps = false;
	public $sortable = ['name','country_id','description'];
	
	public static function lists() {
		$banks = self::where('is_active',1)->get();
		$list = array();
		if($banks) {
			foreach($banks as $key => $row) {
				$list[$row->id] = $row->name;
			}
		}
		return $list;
	} 
 
}