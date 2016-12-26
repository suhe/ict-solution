@extends('ict-backend-theme::main_layout',['title' => $page_title])
@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">{!! Lang::get('app.telephone billing report') !!}</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{!! url('/telephone-billing') !!}">{!! Lang::get('app.telephone billing') !!}</a></li>
                <li><a href="#">{!! Lang::get('app.report') !!}</a></li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <section>
                    <h3 class="box-title"><i class="fa fa-file-o"></i> {!! Lang::get('app.report') !!}</h3>
                    <div class="icon-list-demo clearfix">
                        <div class="col-sm-6 col-md-4 col-lg-3"><i class="fa fa-list"></i>  <a href="{!! url('telephone-billing/report/billing-details') !!}">{!! Lang::get('app.billing details report') !!}</a></div>

                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection