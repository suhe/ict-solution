<?php
namespace App\Modules\AccountBank;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Lang;

class AccountBank extends Model{
	use Sortable;
    protected $table = 'bank_accounts';
    protected $fillable = ['account_no','account_name','bank_id','branch','is_active'];
	protected $primaryKey = "id";
    public $timestamps = false;
	public $sortable = ['account_no','account_name','bank_id','branch','is_active'];

    public static function lists() {
        $lists = self::where('is_active',1)->get();
        $list = array();
        if($lists) {
            foreach($lists as $key => $row) {
                $list[$row->id] = $row->account_no.' '.$row->account_name;
            }
        }
        return $list;
    }

}