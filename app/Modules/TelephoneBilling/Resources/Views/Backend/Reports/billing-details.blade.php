@extends('ict-backend-theme::main_layout',['title' => $page_title])
@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"> {!! $page_title !!}</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            {!! Form::open(['url' => '/telephone-billing/report/billing-details','method'=>'GET','class'=>'form-inline pull-right']) !!}
            <div class="form-group">
                <label>{!! Lang::get('app.search') !!}</label>
                {!! Form::text('query',Request::get('query'),['class' => 'form-control input-sm','id'=>'query','placeholder'=>lang::get('app.keyword'),'maxlength' => 100]) !!}
            </div>
            <div class="form-group">
                <label>{!! Lang::get('app.type') !!}</label>
                {!! Form::select('type',['0' => Lang::get('app.print date'),'1' => Lang::get('app.due date')],Request::get('type'),['class' => 'form-control input-sm','id'=>'type']) !!}
            </div>
            <div class="form-group">
                <label>{!! Lang::get('app.date from') !!}</label>
                {!! Form::text('date_from',Request::get('date_from') ? Request::get('date_from') : date('d/m/Y'),['class' => 'form-control input-sm','id'=>'date_from','maxlength'=>100]) !!}
            </div>
            <div class="form-group">
                <label>{!! Lang::get('app.date to') !!}</label>
                {!! Form::text('date_to',Request::get('date_to') ? Request::get('date_to') : date('d/m/Y'),['class' => 'form-control input-sm','id'=>'date_to','maxlength'=>100]) !!}
            </div>
            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> {!! Lang::get('app.search') !!}</button>
            {!! Form::close()!!}
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row"  style="margin-bottom: 10px">
        <div class="col-lg-12">
            <div class="btn-group pull-right">
                <a href="{!! url('/telephone-billing/export/excel/billing-details?query='.Request::get('query').'&type='.Request::get('type').'&date_from='.Request::get('date_from').'&date_to='.Request::get('date_to').'') !!}" class="btn btn-primary"><i class="fa fa-file-excel-o"></i>  {!! Lang::get('app.export excel') !!}</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="white-box">
                <table class="table">
                    <thead>
                    <tr>
                        <th class="col-md-1">{!! Lang::get('app.no') !!}</th>
                        <th class="col-md-2">>@sortablelink('identity_number', Lang::get('app.customer id'))</th>
                        <th class="col-md-1">>@sortablelink('service_period', Lang::get('app.period'))</th></th>
                        <th class="col-md-2">>@sortablelink('customer_id', Lang::get('app.customer name'))</th>
                        <th class="col-md-1 text-center">@sortablelink('total', Lang::get('app.total'))</th>
                        <th class="col-md-1">>@sortablelink('number', Lang::get('app.invoice no'))</th>
                        <th class="col-md-1">>@sortablelink('print_date', Lang::get('app.print date'))</th>
                        <th class="col-md-1">>@sortablelink('due_date', Lang::get('app.due date'))</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($reports as $key => $report)
                            <tr>
                                <td>{!! (Request::get('page') + $key + 1) !!}</td>
                                <td>{!! $report->identity_number !!}</td>
                                <td>{!! $report->service_period !!}</td>
                                <td>{!! $report->customer_name !!}</td>
                                <td class="text-right">{!! number_format($report->total_bill,2) !!}</td>
                                <td>{!! $report->number !!}</td>
                                <td>{!! $report->print_date !!}</td>
                                <td>{!! $report->due_date !!}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('stylesheet')
<link href="{!! Theme::asset('vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') !!}" rel="stylesheet"/>
@endpush
@push('scripts')
<script src="{!! Theme::asset('vendor/eonasdan-datetimepicker/build/js/moment.min.js') !!}"></script>
<script src="{!! Theme::asset('vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') !!}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        jQuery('#date_from,#date_to').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
            todayHighlight: true
        });
    });
</script>
@endpush
