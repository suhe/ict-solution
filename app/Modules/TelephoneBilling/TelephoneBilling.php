<?php
namespace App\Modules\TelephoneBilling;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Lang;

class TelephoneBilling extends Model{
	use Sortable;
    protected $table = 'telephone_billings';
    protected $fillable = ['number','is_active'];
	protected $primaryKey = "id";
    public $timestamps = false;
	public $sortable = ['number',];
	
	
 
}