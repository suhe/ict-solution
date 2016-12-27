@extends('ict-backend-theme::main_layout',['title' => $page_title])
@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">{!!  Lang::get('app.dashboard') !!}</h4>
        </div>
    </div>
    <!--/.row -->
    <div class="row">
        <div class="col-md-6">
            <div class="white-box">
                <h3 class="box-title">{!! Lang::get('app.company information') !!}</h3>
                <table class="table table-striped table-bordered">
                    <tbody>
                        <tr>
                            <td class="col-md-3">{!! Lang::get('app.company name') !!}</td>
                            <td class="col-md-9">{!! $company->name !!}</td>
                        </tr>
                        <tr>
                            <td class="col-md-3">{!! Lang::get('app.npwp') !!}</td>
                            <td class="col-md-9">{!! $company->npwp !!}</td>
                        </tr>
                        <tr>
                            <td class="col-md-3">{!! Lang::get('app.address') !!}</td>
                            <td class="col-md-9">{!! $company->address_1  !!} <br/>{!! $company->address_2  !!} </td>
                        </tr>
                        <tr>
                            <td class="col-md-3">{!! Lang::get('app.phone number') !!}</td>
                            <td class="col-md-9">{!! $company->phone_number  !!} </td>
                        </tr>
                        <tr>
                            <td class="col-md-3">{!! Lang::get('app.fax number') !!}</td>
                            <td class="col-md-9">{!! $company->fax_number  !!} </td>
                        </tr>
                        <tr>
                            <td class="col-md-3">{!! Lang::get('app.city') !!}</td>
                            <td class="col-md-9">{!! $company->city  !!} {!! $company->zip_code  !!}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-6">
            <div class="white-box">
                <h3 class="box-title">{!! Lang::get('app.latest billing') !!}</h3>
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th class="col-md-3">{!! Lang::get('app.invoice no') !!}</th>
                        <th class="col-md-9">{!! Lang::get('app.company name') !!}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($latest_billings as $key => $row)
                    <tr>
                        <td>{!! $row->number !!}</td>
                        <td>{!! $row->customer_name !!}</td>
                    </tr>
                    @endforeach
                    @if(Role::access('r','telephone-billing'))
                    <tfoot>
                    <tr>
                        <td colspan="2" class="text-center"><a class="btn btn-primary btn-rounded" href="{!! url('/telephone-billing') !!}">{!! Lang::get('app.load more') !!}</a></td>
                    </tr>
                    </tfoot>
                    @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection