<?php
namespace App\Modules\TelephoneBilling\Http\Controllers\Backend;
use App\Modules\TelephoneBilling\TelephoneBilling;
use Illuminate\Routing\Controller;
use Auth;
use Excel;
use Lang;
use Request;

class TelephoneBillingExcelController extends Controller {
    public function billing_details() {
        Excel::create("Billing-Details",function($excel)  {
            $excel->setTitle(Lang::get('app.billing details'));
            $excel->sheet(strtoupper(Lang::get('xls.bill summary')), function($sheet) {
                $sheet->setOrientation('landscape');
                $sheet->setPageMargin(array(0.25, 0.30, 0.25, 0.30));
                $sheet->setStyle(array('font' => array('name' => 'Arial','size'=> 8,'bold'=> false)));

                $row = 1;
                $cols = range('A', 'Z');

                $sheet->setSize([
                    'A1' => [
                        'height' => 20.25,
                    ],
                    'A2' => [
                        'height' => 20.25,
                    ],
                ]);

                $sheet->setWidth(array(
                    'A' => 6,
                    'B' => 14,
                    'C' => 14,
                    'D' => 9,
                    'E' => 23,
                    'F' => 53,
                    'G' => 21,
                    'H' => 40,
                    'I' => 69,
                    'J' => 61,
                    'K' => 16,
                    'L' => 9,
                    'M' => 13,
                    'N' => 12,
                    'O' => 17,
                    'P' => 16,
                    'Q' => 16,
                    'R' => 16,
                    'S' => 16,
                    'T' => 16,
                    'U' => 16,
                    'V' => 16,
                    'W' => 16,
                    'X' => 16,
                    'Y' => 16,
                    'Z' => 16
                ));

                $sheet->setColumnFormat(array(
                    'M' => '0.00',
                    'N' => '0.00',
                    'O' => '0.00',
                    'P' => '0.00',
                    'Q' => '0.00',
                    'R' => '0.00',
                    'S' => '0.00',
                    'T' => '0.00',
                    'U' => '0.00',
                    'V' => '0.00',
                    'W' => '0.00',
                ));

                foreach($cols as $key => $col) {
                    $sheet->cell($cols[$key].$row,function ($cells) use ($key) {
                        $cells->setValue($key + 1);
                        $cells->setAlignment('center');
                        $cells->setValignment('center');
                    });
                }

                //columns
                $row++;
                $colx = array (
                    0 => [
                        'name' => Lang::get('xls.code'),
                        'label' => 'A',
                    ],
                    1 => [
                        'name' => Lang::get('xls.customer id'),
                        'label' => 'B'
                    ],
                    2 => [
                        'name' => Lang::get('xls.period'),
                        'label' => 'C'
                    ],
                    3 => [
                        'name' => Lang::get('xls.service'),
                        'label' => 'D'
                    ],
                    4 => [
                        'name' => Lang::get('xls.tenant'),
                        'label' => 'E'
                    ],
                    5 => [
                        'name' => Lang::get('xls.name'),
                        'label' => 'F'
                    ],
                    6 => [
                        'name' => Lang::get('xls.contact person'),
                        'label' => 'G'
                    ],
                    7 => [
                        'name' => Lang::get('xls.position'),
                        'label' => 'H'
                    ],
                    8 => [
                        'name' => Lang::get('xls.building address'),
                        'label' => 'I'
                    ],
                    9 => [
                        'name' => Lang::get('xls.address'),
                        'label' => 'J'
                    ],
                    10 => [
                        'name' => Lang::get('xls.city'),
                        'label' => 'K'
                    ],
                    11 => [
                        'name' => Lang::get('xls.zip code'),
                        'label' => 'L'
                    ],
                    12 => [
                        'name' => Lang::get('xls.abodemen'),
                        'label' => 'M'
                    ],
                    13 => [
                        'name' => Lang::get('xls.japati'),
                        'label' => 'N'
                    ],
                    14 => [
                        'name' => Lang::get('xls.mobile call'),
                        'label' => 'O'
                    ],
                    15 => [
                        'name' => Lang::get('xls.local'),
                        'label' => 'P'
                    ],
                    16 => [
                        'name' => Lang::get('xls.sljj'),
                        'label' => 'Q'
                    ],
                    17 => [
                        'name' => Lang::get('xls.sli 007'),
                        'label' => 'R'
                    ],
                    18 => [
                        'name' => Lang::get('xls.telkom global 017'),
                        'label' => 'S'
                    ],
                    19 => [
                        'name' => Lang::get('xls.total'),
                        'label' => 'T'
                    ],
                    20 => [
                        'name' => Lang::get('xls.surcharge'),
                        'label' => 'U'
                    ],
                    21 => [
                        'name' => Lang::get('xls.ppn'),
                        'label' => 'V'
                    ],
                    22 => [
                        'name' => Lang::get('xls.total'),
                        'label' => 'W'
                    ],
                    23 => [
                        'name' => Lang::get('xls.invoice no'),
                        'label' => 'X'
                    ],
                    24 => [
                        'name' => Lang::get('xls.print date'),
                        'label' => 'Y'
                    ],
                    25 => [
                        'name' => Lang::get('xls.due date'),
                        'label' => 'Z'
                    ],
                );

                foreach($colx as $key => $col) {
                    $sheet->cell($col["label"].$row, function($cells) use ($key,$col) {
                        $cells->setValue(strtoupper($col['name']));
                        $cells->setAlignment('center');
                        $cells->setFontWeight('bold');
                        $cells->setValignment('center');
                    });
                }

                $row++;
                //database
                $telephone_billings = TelephoneBilling::join('customers','customers.id','=','telephone_billings.customer_id')
                    ->leftJoin('customer_groups','customer_groups.id','=','customers.customer_group_id')
                    ->leftJoin('cities','cities.id','=','customers.city_id')
                    ->whereRaw("CONCAT(number,' ',customers.identity_number,' ',customers.name) LIKE '%".Request::get('query')."%'");

                if(Request::get('type') == 1) {
                    $telephone_billings =$telephone_billings->whereRaw("due_date >= '".preg_replace('!(\d+)/(\d+)/(\d+)!', '\3-\2-\1',Request::get('date_from'))."' AND due_date <= '".preg_replace('!(\d+)/(\d+)/(\d+)!', '\3-\2-\1', Request::get('date_to'))."'");
                } else {
                    $telephone_billings = $telephone_billings->whereRaw("print_date >= '".preg_replace('!(\d+)/(\d+)/(\d+)!', '\3-\2-\1',Request::get('date_from'))."' AND print_date <= '".preg_replace('!(\d+)/(\d+)/(\d+)!', '\3-\2-\1', Request::get('date_to'))."'");
                }

                $telephone_billings = $telephone_billings
                    ->selectRaw("telephone_billings.*,customers.name as customer_name,customers.identity_number,customers.contact_person,customers.contact_position,customer_groups.name as customer_group,cities.name as city,customers.zip_code")
                    ->selectRaw("customers.building_address,customers.address,DATE_FORMAT(print_date,'%d/%m/%Y') as print_date,DATE_FORMAT(due_date,'%d/%m/%Y') as due_date")
                    ->get();

                $no = 1;
                foreach($telephone_billings as $key => $rec) {
                    $colx = array (
                        0 => [
                            'name' => $no,
                            'label' => 'A',
                        ],
                        1 => [
                            'name' => $rec->identity_number,
                            'label' => 'B'
                        ],
                        2 => [
                            'name' => $rec->service_period,
                            'label' => 'C'
                        ],
                        3 => [
                            'name' => "IP PHONE",
                            'label' => 'D'
                        ],
                        4 => [
                            'name' => $rec->customer_group,
                            'label' => 'E'
                        ],
                        5 => [
                            'name' => $rec->customer_name,
                            'label' => 'F'
                        ],
                        6 => [
                            'name' => $rec->contact_person,
                            'label' => 'G'
                        ],
                        7 => [
                            'name' => $rec->contact_position,
                            'label' => 'H'
                        ],
                        8 => [
                            'name' => $rec->building_address,
                            'label' => 'I'
                        ],
                        9 => [
                            'name' => $rec->address,
                            'label' => 'J'
                        ],
                        10 => [
                            'name' => $rec->city,
                            'label' => 'K'
                        ],
                        11 => [
                            'name' => $rec->zip_code,
                            'label' => 'L'
                        ],
                        12 => [
                            'name' => $rec->abodemen,
                            'label' => 'M'
                        ],
                        13 => [
                            'name' => $rec->japati,
                            'label' => 'N'
                        ],
                        14 => [
                            'name' => $rec->mobile,
                            'label' => 'O'
                        ],
                        15 => [
                            'name' => $rec->local,
                            'label' => 'P'
                        ],
                        16 => [
                            'name' => $rec->sljj,
                            'label' => 'Q'
                        ],
                        17 => [
                            'name' => $rec->sli_007,
                            'label' => 'R'
                        ],
                        18 => [
                            'name' => $rec->telkom_global_017,
                            'label' => 'S'
                        ],
                        19 => [
                            'name' => ($rec->japati + $rec->mobile + $rec->local +  $rec->sljj + $rec->sli_007 + $rec->telkom_global_017),
                            'label' => 'T'
                        ],
                        20 => [
                            'name' => $rec->surcharge_total,
                            'label' => 'U'
                        ],
                        21 => [
                            'name' => $rec->ppn_total,
                            'label' => 'V'
                        ],
                        22 => [
                            'name' => $rec->total_bill,
                            'label' => 'W'
                        ],
                        23 => [
                            'name' => $rec->number,
                            'label' => 'X'
                        ],
                        24 => [
                            'name' => $rec->print_date,
                            'label' => 'Y'
                        ],
                        25 => [
                            'name' => $rec->due_date,
                            'label' => 'Z'
                        ],
                    );

                    foreach($colx as $key => $col) {
                        $sheet->cell($col["label"].$row, function($cells) use ($key,$col) {
                            $cells->setValue(strtoupper($col['name']));
                            $cells->setValignment('center');
                        });
                    }

                    $no++;
                    $row++;
                }

            });
        })->export('xlsx');
    }
}

