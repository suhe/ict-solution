<?php
namespace App\Modules\CustomerGroup;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Lang;

class CustomerGroup extends Model{
	use Sortable;
    protected $table = 'customer_groups';
    protected $fillable = ['name','is_active'];
	protected $primaryKey = "id";
    public $timestamps = false;
	public $sortable = ['name',];
	
	
 
}