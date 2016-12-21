<?php
namespace App\Modules\Customer;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Lang;

class Customer extends Model{
	use Sortable;
    protected $table = 'customers';
    protected $fillable = ['name','is_active'];
	protected $primaryKey = "id";
    public $timestamps = false;
	public $sortable = ['identity_number',];
 
}