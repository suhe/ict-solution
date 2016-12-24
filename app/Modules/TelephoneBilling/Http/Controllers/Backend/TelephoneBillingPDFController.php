<?php
namespace App\Modules\TelephoneBilling\Http\Controllers\Backend;
use Illuminate\Routing\Controller;
use App\Modules\Company\Company;
use Auth;
use Lang;
use PDF;
use Symfony\Component\Console\Tests\CustomDefaultCommandApplication;

class TelephoneBillingPDFController extends Controller {
    public function invoice($id,$output='D') {
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

        PDF::Output("invoice_billing.pdf",$output);
    }

}