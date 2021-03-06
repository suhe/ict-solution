<?php
namespace App\Modules\TelephoneBilling\Http\Controllers\Backend;
use App\Modules\TelephoneBilling\TelephoneBilling;
use App\Modules\TelephoneBilling\TelephoneBillingDetail;
use App\Modules\TelephoneBilling\TelephoneBillingPayment;
use Illuminate\Routing\Controller;
use App\Modules\Company\Company;
use Auth;
use Illuminate\Support\Facades\Crypt;
use Lang;
use PDF;


class TelephoneBillingPDFController extends Controller {
    public function billing_statement($id,$output='D') {
        PDF::SetTitle(Lang::get('global.invoice'));
        PDF::AddPage('L', 'A4');
        PDF::setJPEGQuality(100);
        PDF::SetFillColor(255, 255, 255);
        PDF::Image(asset('shared/img/logo.png'), 15, 10, 30, 10, 'PNG', 'http://www.vileo.co.id', '', true, 100, '', false, false, 0, false, false, false);

        $margin_left = 14;
        $y = 8;

        PDF::SetFont('Helvetica','B',12,'','false');
        $x = $margin_left + 160;
        $y = $y;
        PDF::SetXY($x,$y);
        PDF::Cell(90,10,strtoupper(Lang::get('pdf.telephone billing statement')),0,0,'L',false,'',0,10,'T','M');

        PDF::SetFont('Helvetica','I',8,'','false');
        PDF::SetXY($x,$y+4);
        PDF::Cell(90,10,strtoupper(Lang::get('app.telephone billing statement')),0,0,'L',false,'',0,10,'T','M');

        /** Billing Customer Info */
        $billing = TelephoneBilling::join('customers','customers.id','=','telephone_billings.customer_id')
            ->leftJoin('cities','cities.id','=','customers.city_id')
            ->leftJoin('payment_method','payment_method.id','=','telephone_billings.payment_method_id')
            ->selectRaw("telephone_billings.*,DATE_FORMAT(print_date,'%d/%m/%Y') as print_date,DATE_FORMAT(due_date,'%d/%m/%Y') as due_date")
            ->selectRaw("customers.name,customers.identity_number,customers.name as customer_name,customers.address as customer_address,cities.name as customer_city,customers.zip_code as customer_zip_code,customers.contact_person as customer_contact_person,customers.contact_position as customer_contact_position")
            ->selectRaw("payment_method.name as payment_method")
            ->where(['telephone_billings.id' => Crypt::decrypt($id)])
            ->first();

        PDF::SetFont('Helvetica','',8,'','false');


        PDF::SetXY($x,$y+10);
        PDF::Cell(30,10,strtoupper(Lang::get('pdf.invoice no')),0,0,'L',false,'',0,10,'T','M');
        PDF::SetXY($x+30,$y+10);
        PDF::Cell(5,10,':',0,0,'C',false,'',0,10,'T','M');
        PDF::SetXY($x+30+5,$y+10);
        PDF::Cell(30,10,$billing->number,0,0,'L',false,'',0,10,'T','M');

        PDF::SetXY($x,$y+10+4);
        PDF::Cell(30,10,Lang::get('pdf.customer no'),0,0,'L',false,'',0,10,'T','M');
        PDF::SetXY($x+30,$y+10+4);
        PDF::Cell(5,10,':',0,0,'C',false,'',0,10,'T','M');
        PDF::SetXY($x+30+5,$y+10+4);
        PDF::Cell(30,10,$billing->identity_number,0,0,'L',false,'',0,10,'T','M');

        PDF::SetXY($x,$y+10+4+4);
        PDF::Cell(30,10,Lang::get('pdf.payment method'),0,0,'L',false,'',0,10,'T','M');
        PDF::SetXY($x+30,$y+10+4+4);
        PDF::Cell(5,10,':',0,0,'C',false,'',0,10,'T','M');
        PDF::SetXY($x+30+5,$y+10+4+4);
        PDF::Cell(30,10,$billing->payment_method,0,0,'L',false,'',0,10,'T','M');

        PDF::SetXY($x,$y+10+4+4+4);
        PDF::Cell(30,10,Lang::get('pdf.payment frequency'),0,0,'L',false,'',0,10,'T','M');
        PDF::SetXY($x+30,$y+10+4+4+4);
        PDF::Cell(5,10,':',0,0,'C',false,'',0,10,'T','M');
        PDF::SetXY($x+30+5,$y+10+4+4+4);
        PDF::Cell(30,10,$billing->payment_frequency,0,0,'L',false,'',0,10,'T','M');

        PDF::SetXY($x,$y+10+4+4+4+4);
        PDF::Cell(30,10,Lang::get('pdf.print date'),0,0,'L',false,'',0,10,'T','M');
        PDF::SetXY($x+30,$y+10+4+4+4+4);
        PDF::Cell(5,10,':',0,0,'C',false,'',0,10,'T','M');
        PDF::SetXY($x+30+5,$y+10+4+4+4+4);
        PDF::Cell(30,10,$billing->print_date,0,0,'L',false,'',0,10,'T','M');

        PDF::SetXY($x,$y+10+4+4+4+4+4);
        PDF::Cell(30,10,Lang::get('pdf.due date'),0,0,'L',false,'',0,10,'T','M');
        PDF::SetXY($x+30,$y+10+4+4+4+4+4);
        PDF::Cell(5,10,':',0,0,'C',false,'',0,10,'T','M');
        PDF::SetXY($x+30+5,$y+10+4+4+4+4+4);
        PDF::Cell(30,10,$billing->due_date,0,0,'L',false,'',0,10,'T','M');

        PDF::SetXY($x,$y+10+4+4+4+4+4+4);
        PDF::Cell(30,10,Lang::get('pdf.service period'),0,0,'L',false,'',0,10,'T','M');
        PDF::SetXY($x+30,$y+10+4+4+4+4+4+4);
        PDF::Cell(5,10,':',0,0,'C',false,'',0,10,'T','M');
        PDF::SetXY($x+30+5,$y+10+4+4+4+4+4+4);
        PDF::Cell(30,10,$billing->service_period,0,0,'L',false,'',0,10,'T','M');

        /**
         * Get Company
         */
        $company  = Company::leftJoin('cities','cities.id','=','companies.city_id')
            ->selectRaw("companies.*,cities.name as city")
            ->where('companies.id',Auth::user()->company_id)
            ->first();

        $x=$margin_left;$y=$y+10;
        PDF::SetFont('Helvetica','B',10,'','false');
        PDF::SetXY($x,$y=$y);
        PDF::Cell(180,10,strtoupper($company->name),0,0,'L',false,'',0,10,'T','M');

        PDF::SetFont('Helvetica','',8,'','false');

        $y = $y + 7;
        PDF::SetXY($x,$y);
        PDF::Cell(60,5,strtoupper(Lang::get('pdf.npwp'))." : ".$company->npwp,0,0,'L',false,'',0,5,'T','M');

        $y = $y + 4;
        PDF::SetXY($x,$y);
        PDF::Cell(60,5,$company->address_1,0,0,'L',false,'',0,5,'T','M');

        $y = $y + 4;
        PDF::SetXY($x,$y);
        PDF::Cell(60,5,$company->address_2,0,0,'L',false,'',0,5,'T','M');

        $y = $y + 4;
        PDF::SetXY($x,$y);
        PDF::Cell(60,5,$company->city.' '.$company->zip_code.' Indonesia',0,0,'L',false,'',0,5,'T','M');

        $y = $y + 10;
        PDF::SetXY($x,$y);
        PDF::Cell(30,5,strtoupper(Lang::get('pdf.to regard')),0,0,'L',false,'',0,5,'T','M');

        $y = $y + 4;
        PDF::SetXY($x,$y);
        PDF::Cell(100,5,$billing->customer_name,0,0,'L',false,'',0,5,'T','M');
        $y = $y + 4;
        PDF::SetXY($x,$y);
        PDF::Cell(100,5,$billing->customer_address,0,0,'L',false,'',0,5,'T','M');
        $y = $y + 4;
        PDF::SetXY($x,$y);
        PDF::Cell(100,5,$billing->customer_city.' '.$billing->customer_zip_code,0,0,'L',false,'',0,5,'T','M');

        $y = $y + 8;
        PDF::SetXY($x,$y);
        PDF::Cell(20,5,strtoupper(Lang::get('pdf.attn')),0,0,'L',false,'',0,5,'T','M');
        PDF::SetXY($x+20,$y);
        PDF::Cell(5,5,":",0,0,'C',false,'',0,5,'T','M');
        PDF::SetXY($x+20+5,$y);
        PDF::Cell(60,5,$billing->customer_contact_person,0,0,'L',false,'',0,5,'T','M');
        $y = $y + 4;
        PDF::SetXY($x,$y);
        PDF::Cell(20,5,strtoupper(Lang::get('pdf.position')),0,0,'L',false,'',0,5,'T','M');
        PDF::SetXY($x+20,$y);
        PDF::Cell(5,5,":",0,0,'C',false,'',0,5,'T','M');
        PDF::SetXY($x+20+5,$y);
        PDF::Cell(60,5,$billing->customer_contact_position,0,0,'L',false,'',0,5,'T','M');

        $y = $y + 8;
        PDF::SetFillColor(211,211,211);// Grey

        $col01 = 30;
        $col02 = 20;
        $col03 = 20;
        $col04 = 20;
        $col05 = 20;
        $col06 = 20;
        $col07 = 20;
        $col08 = 20;
        $col09 = 20;
        $col10 = 20;
        $col11 = 20;
        $col12 = 15;
        $col13 = 25;


        PDF::SetFont('Helvetica','',6,'','false');
        PDF::SetXY($x,$y);
        PDF::Cell($col01,5,strtoupper(Lang::get('pdf.telephone number')),1,1,'C',true,'',1,5,'T','M');
        PDF::SetXY($x+$col01,$y);
        PDF::Cell($col02,5,strtoupper(Lang::get('pdf.period')),1,1,'C',true,'',1,5,'T','M');
        PDF::SetXY($x+$col01+$col02,$y);
        PDF::Cell($col03,5,strtoupper(Lang::get('pdf.abodemen')),1,1,'C',true,'',1,5,'T','M');
        PDF::SetXY($x+$col01+$col02+$col03,$y);
        PDF::Cell($col04,5,strtoupper(Lang::get('pdf.japati')),1,1,'C',true,'',1,5,'T','M');
        PDF::SetXY($x+$col01+$col02+$col03+$col04,$y);
        PDF::Cell($col05,5,strtoupper(Lang::get('pdf.mobile call')),1,1,'C',true,'',1,5,'T','M');
        PDF::SetXY($x+$col01+$col02+$col03+$col04+$col05,$y);
        PDF::Cell($col06,5,strtoupper(Lang::get('pdf.local')),1,1,'C',true,'',1,5,'T','M');
        PDF::SetXY($x+$col01+$col02+$col03+$col04+$col05+$col06,$y);
        PDF::Cell($col07,5,strtoupper(Lang::get('pdf.sljj')),1,1,'C',true,'',1,5,'T','M');
        PDF::SetXY($x+$col01+$col02+$col03+$col04+$col05+$col06+$col07,$y);
        PDF::Cell($col08,5,strtoupper(Lang::get('pdf.sli 007')),1,1,'C',true,'',1,5,'T','M');
        PDF::SetXY($x+$col01+$col02+$col03+$col04+$col05+$col06+$col07+$col08,$y);
        PDF::Cell($col09,5,strtoupper(Lang::get('pdf.telkom global 017')),1,1,'C',true,'',1,5,'T','M');
        PDF::SetXY($x+$col01+$col02+$col03+$col04+$col05+$col06+$col07+$col08+$col09,$y);
        PDF::Cell($col10,5,strtoupper(Lang::get('pdf.total')),1,1,'C',true,'',1,5,'T','M');
        PDF::SetXY($x+$col01+$col02+$col03+$col04+$col05+$col06+$col07+$col08+$col09+$col10,$y);
        PDF::Cell($col11,5,strtoupper(Lang::get('pdf.surcharge')),1,1,'C',true,'',1,5,'T','M');
        PDF::SetXY($x+$col01+$col02+$col03+$col04+$col05+$col06+$col07+$col08+$col09+$col10+$col11,$y);
        PDF::Cell($col12,5,strtoupper(Lang::get('pdf.ppn')),1,1,'C',true,'',1,5,'T','M');
        PDF::SetXY($x+$col01+$col02+$col03+$col04+$col05+$col06+$col07+$col08+$col09+$col10+$col11+$col12,$y);
        PDF::Cell($col13,5,strtoupper(Lang::get('pdf.total')),1,1,'C',true,'',1,5,'T','M');

        /**
         * Billing Details
         */
        $billing_details = TelephoneBillingDetail::where(['telephone_billing_id'=>$billing->id])->get();
        $y = $y + 5;
        foreach($billing_details as $key => $row) {
            PDF::SetXY($x,$y);
            PDF::Cell($col01,5,$row->phone_number,1,1,'L',false,'',1,5,'T','M');
            PDF::SetXY($x+$col01,$y);
            PDF::Cell($col02,5,$row->period,1,1,'L',false,'',1,5,'T','M');
            PDF::SetXY($x+$col01+$col02,$y);
            PDF::Cell($col03,5,number_format($row->abodemen,2),1,1,'R',false,'',1,5,'T','M');
            PDF::SetXY($x+$col01+$col02+$col03,$y);
            PDF::Cell($col04,5,number_format($row->japati,2),1,1,'R',false,'',1,5,'T','M');
            PDF::SetXY($x+$col01+$col02+$col03+$col04,$y);
            PDF::Cell($col05,5,number_format($row->mobile,2),1,1,'R',false,'',1,5,'T','M');
            PDF::SetXY($x+$col01+$col02+$col03+$col04+$col05,$y);
            PDF::Cell($col06,5,number_format($row->local,2),1,1,'R',false,'',1,5,'T','M');
            PDF::SetXY($x+$col01+$col02+$col03+$col04+$col05+$col06,$y);
            PDF::Cell($col07,5,number_format($row->sljj,2),1,1,'R',false,'',1,5,'T','M');
            PDF::SetXY($x+$col01+$col02+$col03+$col04+$col05+$col06+$col07,$y);
            PDF::Cell($col08,5,number_format($row->sli_007,2),1,1,'R',false,'',1,5,'T','M');
            PDF::SetXY($x+$col01+$col02+$col03+$col04+$col05+$col06+$col07+$col08,$y);
            PDF::Cell($col09,5,number_format($row->telkom_global_017,2),1,1,'R',false,'',1,5,'T','M');
            PDF::SetXY($x+$col01+$col02+$col03+$col04+$col05+$col06+$col07+$col08+$col09,$y);
            $xtotal = $row->japati +  $row->mobile + $row->local + $row->sljj + $row->sli_007 + $row->telkom_global_017;
            PDF::Cell($col10,5,number_format($xtotal,2),1,1,'R',false,'',1,5,'T','M');
            PDF::SetXY($x+$col01+$col02+$col03+$col04+$col05+$col06+$col07+$col08+$col09+$col10,$y);
            PDF::Cell($col11,5,number_format($row->surcharge_total,2),1,1,'R',false,'',1,5,'T','M');
            PDF::SetXY($x+$col01+$col02+$col03+$col04+$col05+$col06+$col07+$col08+$col09+$col10+$col11,$y);
            PDF::Cell($col12,5,number_format($row->ppn_total,2),1,1,'R',false,'',1,5,'T','M');
            PDF::SetXY($x+$col01+$col02+$col03+$col04+$col05+$col06+$col07+$col08+$col09+$col10+$col11+$col12,$y);
            PDF::Cell($col13,5,number_format($row->subtotal,2),1,1,'R',false,'',1,5,'T','M');

            $y = $y + 5;
        }

        PDF::Output("billing-statement-".$billing->number.".pdf",$output);
    }

    public function billing_invoice($id,$output='D') {
        PDF::SetTitle(Lang::get('global.invoice'));
        PDF::AddPage('P', 'A4');
        PDF::setJPEGQuality(100);
        PDF::SetFillColor(255, 255, 255);
        PDF::Image(asset('shared/img/logo.png'), 15, 10, 30, 10, 'PNG', 'http://www.vileo.co.id', '', true, 100, '', false, false, 0, false, false, false);

        $margin_left = 14;
        $y = 8;

        PDF::SetFont('Helvetica','B',12,'','false');
        $x = $margin_left + 100;
        $y = $y;

        PDF::setFillColor(0,191,255);
        PDF::SetXY($x,$y);
        PDF::SetTextColor(255,255,255);
        PDF::Cell(82,14,strtoupper(Lang::get('pdf.telephone billing statement')),0,0,'L',true,'',0,10,'T','M');

        PDF::SetFont('Helvetica','I',6,'','false');
        PDF::SetXY($x,$y+5);
        PDF::Cell(82,10,strtoupper(Lang::get('app.telephone billing statement')),0,0,'L',false,'',0,10,'T','M');

        PDF::SetTextColor(0,0,0);

        /** Billing Customer Info */
        $billing = TelephoneBilling::join('customers','customers.id','=','telephone_billings.customer_id')
            ->leftJoin('cities','cities.id','=','customers.city_id')
            ->leftJoin('payment_method','payment_method.id','=','telephone_billings.payment_method_id')
            ->selectRaw("telephone_billings.*,DATE_FORMAT(print_date,'%d/%m/%Y') as print_date,DATE_FORMAT(due_date,'%d/%m/%Y') as due_date")
            ->selectRaw("customers.name,customers.identity_number,customers.name as customer_name,customers.address as customer_address,cities.name as customer_city,customers.zip_code as customer_zip_code,customers.contact_person as customer_contact_person,customers.contact_position as customer_contact_position")
            ->selectRaw("payment_method.name as payment_method")
            ->where(['telephone_billings.id' => Crypt::decrypt($id)])
            ->first();

        PDF::SetFont('Helvetica','',8,'','false');


        PDF::SetXY($x,$y+15);
        PDF::Cell(30,10,strtoupper(Lang::get('pdf.invoice no')),0,0,'L',false,'',0,10,'T','M');
        PDF::SetXY($x+30,$y+15);
        PDF::Cell(5,10,':',0,0,'C',false,'',0,10,'T','M');
        PDF::SetXY($x+30+5,$y+15);
        PDF::Cell(30,10,$billing->number,0,0,'L',false,'',0,10,'T','M');

        PDF::SetXY($x,$y+15+4);
        PDF::Cell(30,10,Lang::get('pdf.customer no'),0,0,'L',false,'',0,10,'T','M');
        PDF::SetXY($x+30,$y+15+4);
        PDF::Cell(5,10,':',0,0,'C',false,'',0,10,'T','M');
        PDF::SetXY($x+30+5,$y+15+4);
        PDF::Cell(30,10,$billing->identity_number,0,0,'L',false,'',0,10,'T','M');

        PDF::SetXY($x,$y+15+4+4);
        PDF::Cell(30,10,Lang::get('pdf.payment method'),0,0,'L',false,'',0,10,'T','M');
        PDF::SetXY($x+30,$y+15+4+4);
        PDF::Cell(5,10,':',0,0,'C',false,'',0,10,'T','M');
        PDF::SetXY($x+30+5,$y+15+4+4);
        PDF::Cell(30,10,$billing->payment_method,0,0,'L',false,'',0,10,'T','M');

        PDF::SetXY($x,$y+15+4+4+4);
        PDF::Cell(30,10,Lang::get('pdf.payment frequency'),0,0,'L',false,'',0,10,'T','M');
        PDF::SetXY($x+30,$y+15+4+4+4);
        PDF::Cell(5,10,':',0,0,'C',false,'',0,10,'T','M');
        PDF::SetXY($x+30+5,$y+15+4+4+4);
        PDF::Cell(30,10,$billing->payment_frequency,0,0,'L',false,'',0,10,'T','M');

        PDF::SetXY($x,$y+15+4+4+4+4);
        PDF::Cell(30,10,Lang::get('pdf.print date'),0,0,'L',false,'',0,10,'T','M');
        PDF::SetXY($x+30,$y+15+4+4+4+4);
        PDF::Cell(5,10,':',0,0,'C',false,'',0,10,'T','M');
        PDF::SetXY($x+30+5,$y+15+4+4+4+4);
        PDF::Cell(30,10,$billing->print_date,0,0,'L',false,'',0,10,'T','M');

        PDF::SetXY($x,$y+15+4+4+4+4+4);
        PDF::Cell(30,10,Lang::get('pdf.due date'),0,0,'L',false,'',0,10,'T','M');
        PDF::SetXY($x+30,$y+15+4+4+4+4+4);
        PDF::Cell(5,10,':',0,0,'C',false,'',0,10,'T','M');
        PDF::SetXY($x+30+5,$y+15+4+4+4+4+4);
        PDF::Cell(30,10,$billing->due_date,0,0,'L',false,'',0,10,'T','M');

        PDF::SetXY($x,$y+15+4+4+4+4+4+4);
        PDF::Cell(30,10,Lang::get('pdf.service period'),0,0,'L',false,'',0,10,'T','M');
        PDF::SetXY($x+30,$y+15+4+4+4+4+4+4);
        PDF::Cell(5,10,':',0,0,'C',false,'',0,10,'T','M');
        PDF::SetXY($x+30+5,$y+15+4+4+4+4+4+4);
        PDF::Cell(30,10,$billing->service_period,0,0,'L',false,'',0,10,'T','M');

        /**
         * Get Company
         */
        $company  = Company::leftJoin('cities','cities.id','=','companies.city_id')
            ->selectRaw("companies.*,cities.name as city")
            ->where('companies.id',Auth::user()->company_id)
            ->first();

        $x=$margin_left;$y=$y+10;
        PDF::SetFont('Helvetica','B',10,'','false');
        PDF::SetXY($x,$y=$y);
        PDF::Cell(180,10,strtoupper($company->name),0,0,'L',false,'',0,10,'T','M');

        PDF::SetFont('Helvetica','',8,'','false');

        $y = $y + 7;
        PDF::SetXY($x,$y);
        PDF::Cell(60,5,strtoupper(Lang::get('pdf.npwp'))." : ".$company->npwp,0,0,'L',false,'',0,5,'T','M');

        $y = $y + 4;
        PDF::SetXY($x,$y);
        PDF::Cell(60,5,$company->address_1,0,0,'L',false,'',0,5,'T','M');

        $y = $y + 4;
        PDF::SetXY($x,$y);
        PDF::Cell(60,5,$company->address_2,0,0,'L',false,'',0,5,'T','M');

        $y = $y + 4;
        PDF::SetXY($x,$y);
        PDF::Cell(60,5,$company->city.' '.$company->zip_code.' Indonesia',0,0,'L',false,'',0,5,'T','M');

        $y = $y + 10;
        PDF::SetXY($x,$y);
        PDF::Cell(30,5,strtoupper(Lang::get('pdf.to regard')),0,0,'L',false,'',0,5,'T','M');

        $y = $y + 4;
        PDF::SetXY($x,$y);
        PDF::Cell(100,5,$billing->customer_name,0,0,'L',false,'',0,5,'T','M');
        $y = $y + 4;
        PDF::SetXY($x,$y);
        PDF::Cell(100,5,$billing->customer_address,0,0,'L',false,'',0,5,'T','M');
        $y = $y + 4;
        PDF::SetXY($x,$y);
        PDF::Cell(100,5,$billing->customer_city.' '.$billing->customer_zip_code,0,0,'L',false,'',0,5,'T','M');

        $y = $y + 8;
        PDF::SetXY($x,$y);
        PDF::Cell(20,5,strtoupper(Lang::get('pdf.attn')),0,0,'L',false,'',0,5,'T','M');
        PDF::SetXY($x+20,$y);
        PDF::Cell(5,5,":",0,0,'C',false,'',0,5,'T','M');
        PDF::SetXY($x+20+5,$y);
        PDF::Cell(60,5,$billing->customer_contact_person,0,0,'L',false,'',0,5,'T','M');
        $y = $y + 4;
        PDF::SetXY($x,$y);
        PDF::Cell(20,5,strtoupper(Lang::get('pdf.position')),0,0,'L',false,'',0,5,'T','M');
        PDF::SetXY($x+20,$y);
        PDF::Cell(5,5,":",0,0,'C',false,'',0,5,'T','M');
        PDF::SetXY($x+20+5,$y);
        PDF::Cell(60,5,$billing->customer_contact_position,0,0,'L',false,'',0,5,'T','M');

        $y = $y + 8;

        PDF::setFillColor(0,191,255);
        PDF::SetXY($x,$y);
        PDF::SetTextColor(255,255,255);
        PDF::Cell(184,8,strtoupper(Lang::get('pdf.summary billing')),0,0,'C',true,'',0,10,'T','M');

        PDF::SetTextColor(0,0,0);

        $y = $y + 8;
        PDF::SetXY($x,$y);
        PDF::Cell(150,8,"ICTKNO 25",0,0,'L',false,'',0,10,'T','M');

        $y = $y + 5;
        PDF::SetXY($x,$y);
        PDF::Cell(130,8,strtoupper(Lang::get('pdf.abodemen')),0,0,'L',false,'',0,10,'T','M');
        PDF::SetXY($x+130,$y);
        PDF::Cell(10,8,Lang::get('pdf.idr'),0,0,'C',false,'',0,10,'T','M');
        PDF::SetXY($x+130+10,$y);
        PDF::Cell(44,8,number_format($billing->abodemen,2),0,0,'R',false,'',0,10,'T','M');

        $y = $y + 5;
        PDF::SetXY($x,$y);
        PDF::Cell(130,8,strtoupper(Lang::get('pdf.japati')),0,0,'L',false,'',0,10,'T','M');
        PDF::SetXY($x+130,$y);
        PDF::Cell(10,8,Lang::get('pdf.idr'),0,0,'C',false,'',0,10,'T','M');
        PDF::SetXY($x+130+10,$y);
        PDF::Cell(44,8,number_format($billing->japati,2),0,0,'R',false,'',0,10,'T','M');

        $y = $y + 5;
        PDF::SetXY($x,$y);
        PDF::Cell(130,8,strtoupper(Lang::get('pdf.mobile call')),0,0,'L',false,'',0,10,'T','M');
        PDF::SetXY($x+130,$y);
        PDF::Cell(10,8,Lang::get('pdf.idr'),0,0,'C',false,'',0,10,'T','M');
        PDF::SetXY($x+130+10,$y);
        PDF::Cell(44,8,number_format($billing->mobile,2),0,0,'R',false,'',0,10,'T','M');

        $y = $y + 5;
        PDF::SetXY($x,$y);
        PDF::Cell(130,8,strtoupper(Lang::get('pdf.local')),0,0,'L',false,'',0,10,'T','M');
        PDF::SetXY($x+130,$y);
        PDF::Cell(10,8,Lang::get('pdf.idr'),0,0,'C',false,'',0,10,'T','M');
        PDF::SetXY($x+130+10,$y);
        PDF::Cell(44,8,number_format($billing->local,2),0,0,'R',false,'',0,10,'T','M');

        $y = $y + 5;
        PDF::SetXY($x,$y);
        PDF::Cell(130,8,strtoupper(Lang::get('pdf.sljj')),0,0,'L',false,'',0,10,'T','M');
        PDF::SetXY($x+130,$y);
        PDF::Cell(10,8,Lang::get('pdf.idr'),0,0,'C',false,'',0,10,'T','M');
        PDF::SetXY($x+130+10,$y);
        PDF::Cell(44,8,number_format($billing->sljj,2),0,0,'R',false,'',0,10,'T','M');

        $y = $y + 5;
        PDF::SetXY($x,$y);
        PDF::Cell(130,8,strtoupper(Lang::get('pdf.sli 007')),0,0,'L',false,'',0,10,'T','M');
        PDF::SetXY($x+130,$y);
        PDF::Cell(10,8,Lang::get('pdf.idr'),0,0,'C',false,'',0,10,'T','M');
        PDF::SetXY($x+130+10,$y);
        PDF::Cell(44,8,number_format($billing->sli_007,2),0,0,'R',false,'',0,10,'T','M');

        $y = $y + 5;
        PDF::SetXY($x,$y);
        PDF::Cell(130,8,strtoupper(Lang::get('pdf.telkom global 017')),0,0,'L',false,'',0,10,'T','M');
        PDF::SetXY($x+130,$y);
        PDF::Cell(10,8,Lang::get('pdf.idr'),0,0,'C',false,'',0,10,'T','M');
        PDF::SetXY($x+130+10,$y);
        PDF::Cell(44,8,number_format($billing->telkom_global_017,2),0,0,'R',false,'',0,10,'T','M');

        $y = $y + 5;
        PDF::SetXY($x,$y);
        PDF::Cell(130,8,strtoupper(Lang::get('pdf.surcharge')),0,0,'L',false,'',0,10,'T','M');
        PDF::SetXY($x+130,$y);
        PDF::Cell(10,8,Lang::get('pdf.idr'),0,0,'C',false,'',0,10,'T','M');
        PDF::SetXY($x+130+10,$y);
        PDF::Cell(44,8,number_format($billing->surcharge_total,2),0,0,'R',false,'',0,10,'T','M');

        $y = $y + 5;
        PDF::SetXY($x,$y);
        PDF::Cell(130,8,strtoupper(Lang::get('pdf.ppn')),0,0,'L',false,'',0,10,'T','M');
        PDF::SetXY($x+130,$y);
        PDF::Cell(10,8,Lang::get('pdf.idr'),0,0,'C',false,'',0,10,'T','M');
        PDF::SetXY($x+130+10,$y);
        PDF::Cell(44,8,number_format($billing->ppn_total,2),0,0,'R',false,'',0,10,'T','M');

        $y = $y + 8;
        PDF::SetFillColor(211,211,211);// Grey
        PDF::SetTextColor(0,0,0);

        PDF::SetXY($x,$y);
        PDF::Cell(130,8,strtoupper(Lang::get('pdf.total bill this month')),0,0,'L',true,'',0,10,'T','M');
        PDF::Cell(10,8,Lang::get('pdf.idr'),0,0,'C',true,'',0,10,'T','M');
        PDF::SetXY($x+130+10,$y);
        PDF::Cell(44,8,number_format($billing->total_bill,2),0,0,'R',true,'',0,10,'T','M');

        $y = $y + 12;
        PDF::SetXY($x,$y);
        PDF::Cell(184,8,strtoupper(Lang::get('pdf.be regard'))." : ".strtoupper(regard_format($billing->total_bill))." RUPIAH",0,0,'L',true,'',0,10,'T','M');

        $y = $y + 18;
        PDF::SetXY($x,$y);
        PDF::Cell(40,5,Lang::get('pdf.account name'),0,0,'L',false,'',0,5,'T','M');
        PDF::SetXY($x+40,$y);
        PDF::Cell(5,5,":",0,0,'C',false,'',0,5,'T','M');
        PDF::SetXY($x+40+5,$y);
        PDF::Cell(60,5,"PT Angkasa Pura Solusi",0,0,'L',false,'',0,5,'T','M');

        $y = $y + 5;
        PDF::SetXY($x,$y);
        PDF::Cell(40,5,Lang::get('pdf.bank name'),0,0,'L',false,'',0,5,'T','M');
        PDF::SetXY($x+40,$y);
        PDF::Cell(5,5,":",0,0,'C',false,'',0,5,'T','M');
        PDF::SetXY($x+40+5,$y);
        PDF::Cell(60,5,"Bank Mandiri Terminal II D/E Bandara Soekarno-Hatta",0,0,'L',false,'',0,5,'T','M');

        $y = $y + 5;
        PDF::SetXY($x,$y);
        PDF::Cell(40,5,Lang::get('pdf.acc no'),0,0,'L',false,'',0,5,'T','M');
        PDF::SetXY($x+40,$y);
        PDF::Cell(5,5,":",0,0,'C',false,'',0,5,'T','M');
        PDF::SetXY($x+40+5,$y);
        PDF::Cell(60,5,"116 - 00 - 96011516",0,0,'L',false,'',0,5,'T','M');

        $y = $y + 5;
        PDF::SetXY($x,$y);
        PDF::Cell(60,5,"Konfirmasi bukti transfer melalui email atau faks kepada :",0,0,'L',false,'',0,5,'T','M');

        $y = $y + 5;
        PDF::SetXY($x,$y);
        PDF::Cell(60,5,"Attn. Deasy & Budy",0,0,'L',false,'',0,5,'T','M');

        $y = $y + 5;
        PDF::SetXY($x,$y);
        PDF::Cell(60,5,"Email : billing-ict@aps.co.id",0,0,'L',false,'',0,5,'T','M');

        $y = $y + 9;
        PDF::SetFont('Helvetica','BU',8,'','false');
        PDF::SetXY($x,$y);
        PDF::Cell(60,5,"INFORMASI PENTING",0,0,'L',false,'',0,5,'T','M');

        PDF::SetFont('Helvetica','',8,'','false');
        $y = $y + 5;
        PDF::SetXY($x,$y);
        PDF::Cell(184,5,"Pelanggan Yth; Jika Anda belum menerima tagihan 7 (tujuh) hari sebelum tanggal jatuh tempo, harap segera menghubungi bagian Billing",0,0,'L',false,'',0,5,'T','M');
        $y = $y + 5;
        PDF::SetXY($x,$y);
        PDF::Cell(184,5,"PT ANGKASA PURA SOLUSI di +6221 550 5117 (Ibu Deasy). UNTUK MENGHINDARI PEMUTUSAN LAYANAN, HARAP MELAKUKAN PEMBAYARAN TAGIHAN ",0,0,'L',false,'',0,5,'T','M');
        $y = $y + 5;
        PDF::SetXY($x,$y);
        PDF::Cell(184,5,"SEBELUM JATUH TEMPO.",0,0,'L',false,'',0,5,'T','M');

        $y = $y + 15;
        PDF::SetXY($x,$y);
        PDF::Cell(184,5,"  HORMAT KAMI,",0,0,'L',false,'',0,5,'T','M');

        $y = $y + 25;
        PDF::SetXY($x,$y);
        PDF::Cell(184,5,"( ............................. )",0,0,'L',false,'',0,5,'T','M');

        PDF::Output("billing-invoice-".$billing->number.".pdf",$output);
    }

    public function payment_receipt($id,$output='D') {
        PDF::SetTitle(Lang::get('global.invoice'));
        PDF::AddPage('P', 'A4');
        $margin_left = 15;
        $y = 10;

        /**
         * Get Company
         */
        $company  = Company::leftJoin('cities','cities.id','=','companies.city_id')
            ->selectRaw("companies.*,cities.name as city")
            ->where('companies.id',Auth::user()->company_id)
            ->first();

        /** Billing Customer Info */
        $billing = TelephoneBillingPayment::join('telephone_billings','telephone_billings.id','=','telephone_billing_payments.telephone_billing_id')
            ->join('customers','customers.id','=','telephone_billings.customer_id')
            ->leftJoin('cities','cities.id','=','customers.city_id')
            ->leftJoin('payment_method','payment_method.id','=','telephone_billing_payments.payment_method_id')
            ->selectRaw("telephone_billings.number,DATE_FORMAT(telephone_billing_payments.date,'%d/%m/%Y') as payment_date,telephone_billing_payments.total as payment_total")
            ->selectRaw("customers.name,customers.identity_number,customers.name as customer_name,customers.address as customer_address,cities.name as customer_city,customers.zip_code as customer_zip_code,customers.contact_person as customer_contact_person,customers.contact_position as customer_contact_position")
            ->selectRaw("payment_method.name as payment_method")
            ->where(['telephone_billing_payments.id' => Crypt::decrypt($id)])
            ->first();

        $x=$margin_left;$y=$y;
        PDF::SetFont('Helvetica','B',10,'','false');
        PDF::SetXY($x,$y=$y);
        PDF::Cell(180,10,strtoupper($company->name),0,0,'L',false,'',0,10,'T','M');

        PDF::SetFont('Helvetica','',8,'','false');

        $y = $y + 7;
        PDF::SetXY($x,$y);
        PDF::Cell(60,5,strtoupper(Lang::get('pdf.npwp'))." : ".$company->npwp,0,0,'L',false,'',0,5,'T','M');

        $y = $y + 4;
        PDF::SetXY($x,$y);
        PDF::Cell(60,5,$company->address_1.' '.$company->address_2,0,0,'L',false,'',0,5,'T','M');

        $y = $y + 4;
        PDF::SetXY($x,$y);
        PDF::Cell(60,5,$company->city.' '.$company->zip_code.' Indonesia. Tel.'.$company->phone_number.'. Fax.'.$company->fax_number,0,0,'L',false,'',0,5,'T','M');

        $x=$margin_left;$y=$y+7;
        PDF::SetLineStyle(array('width'=>0.8,'color'=>array(0,191,255)));
        PDF::Line($x,$y,$x+180,$y); //top

        PDF::SetFont('Helvetica','B',13,'','false');

        $y = $y + 7;
        PDF::setFillColor(0,191,255);
        PDF::SetXY($x,$y);
        PDF::SetTextColor(255,255,255);
        PDF::Cell(60,14,strtoupper(Lang::get('pdf.receipt')),0,0,'C',true,'',0,10,'T','M');

        /**
         *  Logo
         */
        PDF::setJPEGQuality(100);
        PDF::SetFillColor(255, 255, 255);
        PDF::Image(asset('shared/img/logo.png'), $x+142, $y, 40, 14, 'PNG', 'http://www.vileo.co.id', '', true, 100, '', false, false, 0, false, false, false);

        PDF::SetTextColor(0,0,0);
        PDF::SetFont('Helvetica','',8,'','false');

        $y = $y + 20;
        PDF::SetXY($x,$y);
        PDF::Cell(30,5,strtoupper(Lang::get('pdf.received from')),0,0,'L',false,'',0,5,'T','M');

        $y = $y + 4;
        PDF::SetXY($x,$y);
        PDF::Cell(100,5,$billing->customer_name,0,0,'L',false,'',0,5,'T','M');
        $y = $y + 4;
        PDF::SetXY($x,$y);
        PDF::Cell(100,5,$billing->customer_address,0,0,'L',false,'',0,5,'T','M');
        $y = $y + 4;
        PDF::SetXY($x,$y);
        PDF::Cell(100,5,$billing->customer_city.' '.$billing->customer_zip_code,0,0,'L',false,'',0,5,'T','M');

        $y = $y + 8;
        PDF::SetXY($x,$y);
        PDF::Cell(20,5,strtoupper(Lang::get('pdf.attn')),0,0,'L',false,'',0,5,'T','M');
        PDF::SetXY($x+20,$y);
        PDF::Cell(5,5,":",0,0,'C',false,'',0,5,'T','M');
        PDF::SetXY($x+20+5,$y);
        PDF::Cell(60,5,$billing->customer_contact_person,0,0,'L',false,'',0,5,'T','M');
        $y = $y + 4;
        PDF::SetXY($x,$y);
        PDF::Cell(20,5,strtoupper(Lang::get('pdf.position')),0,0,'L',false,'',0,5,'T','M');
        PDF::SetXY($x+20,$y);
        PDF::Cell(5,5,":",0,0,'C',false,'',0,5,'T','M');
        PDF::SetXY($x+20+5,$y);
        PDF::Cell(60,5,$billing->customer_contact_position,0,0,'L',false,'',0,5,'T','M');

        //THIS BILLING RECEIPT IS VALID ONLY WHEN THE PAYMENT HAVE ALREADY BEEN RECEIVED
        $y = $y + 8;
        PDF::SetXY($x,$y);
        PDF::Cell(30,5,strtoupper("THIS BILLING RECEIPT IS VALID ONLY WHEN THE PAYMENT HAVE ALREADY BEEN RECEIVED"),0,0,'L',false,'',0,5,'T','M');

        $y = $y + 8;
        PDF::SetFont('Helvetica','B',9,'','false');
        PDF::setFillColor(0,191,255);
        PDF::SetXY($x,$y);
        PDF::SetTextColor(255,255,255);
        PDF::Cell(184,8,strtoupper(Lang::get('pdf.description')),0,0,'C',true,'',0,10,'T','M');

        PDF::setTextColor(0,0,0);
        PDF::SetFont('Helvetica','',8,'','false');

        $y = $y + 10;
        PDF::SetXY($x,$y);
        PDF::Cell(130,8,strtoupper("RECEIVED PAYMENT FROM BILLING STATEMENT NO."),0,0,'L',false,'',0,10,'T','M');
        PDF::SetXY($x+130,$y);
        PDF::Cell(10,8,"",0,0,'C',false,'',0,10,'T','M');
        PDF::SetXY($x+130+10,$y);
        PDF::Cell(44,8,$billing->number,0,0,'R',false,'',0,10,'T','M');

        $y = $y + 7;
        PDF::SetXY($x,$y);
        PDF::Cell(130,8,strtoupper(Lang::get('pdf.payment method')),0,0,'L',false,'',0,10,'T','M');
        PDF::SetXY($x+130,$y);
        PDF::Cell(10,8,"",0,0,'C',false,'',0,10,'T','M');
        PDF::SetXY($x+130+10,$y);
        PDF::Cell(44,8,$billing->payment_method,0,0,'R',false,'',0,10,'T','M');

        $x=$margin_left;$y=$y+10;
        PDF::SetLineStyle(array('width'=>0.1,'color'=>array(0,0,0)));
        PDF::Line($x,$y,$x+184,$y); //top

        PDF::SetFont('Helvetica','B',12,'','false');

        $y = $y;
        PDF::SetXY($x,$y);
        PDF::Cell(130,8,strtoupper(Lang::get('pdf.total')),0,0,'L',false,'',0,10,'T','M');
        PDF::SetXY($x+130,$y);
        PDF::Cell(10,8,strtoupper(Lang::get('pdf.idr')),0,0,'C',false,'',0,10,'T','M');
        PDF::SetXY($x+130+10,$y);
        PDF::Cell(44,8,number_format($billing->payment_total,2),0,0,'R',false,'',0,10,'T','M');

        $x=$margin_left;$y=$y+10;
        PDF::SetLineStyle(array('width'=>0.1,'color'=>array(0,0,0)));
        PDF::Line($x,$y,$x+184,$y); //top

        PDF::SetFont('Helvetica','',8,'','false');

        $y = $y+2;
        PDF::SetXY($x,$y);
        PDF::Cell(130,8,strtoupper(Lang::get('pdf.regard'))." : ".strtoupper(regard_format($billing->payment_total))." RUPIAH",0,0,'L',false,'',0,10,'T','M');

        $y = $y+10;
        PDF::SetXY($x+140,$y);
        PDF::Cell(130,8,strtoupper("Tangerang")." , ".$billing->payment_date,0,0,'L',false,'',0,10,'T','M');

        $y = $y+5;
        PDF::SetXY($x+140,$y);
        PDF::Cell(130,8,strtoupper($company->name),0,0,'L',false,'',0,10,'T','M');

        PDF::SetFont('Helvetica','U',8,'','false');

        $y = $y+15;
        PDF::SetXY($x+140,$y);
        PDF::Cell(130,8,strtoupper("INNA HAKIM"),0,0,'L',false,'',0,10,'T','M');

        PDF::SetFont('Helvetica','',8,'','false');

        $y = $y+4;
        PDF::SetXY($x+140,$y);
        PDF::Cell(130,8,strtoupper("DD ICT & MEDIA"),0,0,'L',false,'',0,10,'T','M');


        PDF::Output("payment-receipt.pdf",$output);

    }

}