<?php
namespace App\Modules\City;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Lang;

class City extends Model{
	use Sortable;
    protected $table = 'cities';
    protected $fillable = ['name','is_active'];
	protected $primaryKey = "id";
    public $timestamps = false;
	public $sortable = ['name',];
	
	public static function lists() {
		$cities = self::where('is_active',1)->get();
		$list = array();
		if($$cities) {
			foreach($cities as $key => $city) {
				$list[$city->id] = $city->name;
			}
		}
		return $list;
	} 
 
}