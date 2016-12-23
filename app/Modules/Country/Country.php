<?php
namespace App\Modules\Country;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Lang;

class Country extends Model{
	use Sortable;
    protected $table = 'countries';
    protected $fillable = ['id','name','is_active'];
	protected $primaryKey = "id";
    public $timestamps = false;
	public $sortable = ['id','name','is_active'];
	
	public static function lists() {
		$countries = self::where('is_active',1)->get();
		$list = array();
		if($countries) {
			foreach($countries as $key => $row) {
				$list[$row->id] = $row->name;
			}
		}
		return $list;
	} 
 
}