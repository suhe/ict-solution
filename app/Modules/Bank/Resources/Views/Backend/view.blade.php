@extends('ict-backend-theme::main_layout',['title' => $page_title])
@section('content')
	<div class="row bg-title">
        <div class="col-lg-6">
          <h4 class="page-title"> {!! $page_title !!}</h4>
        </div>
        <div class="col-lg-6">
			<div class="pull-right">
				<div class="btn-group">
					@if(Role::access('c','bank'))
					<a href="{!! url('/bank/form') !!}" class="btn btn-rounded btn-primary btn-md"><i class="fa fa-plus"></i> {!! Lang::get("app.create") !!}</a>
					@endif
					@if(Role::access('u','bank'))
					<a href="{!! url('/bank/do-publish/'.Crypt::encrypt($data->id)) !!}" class="btn btn-rounded btn-primary btn-md"><i class="fa fa-flag"></i> {!! isset($data) && $data->is_active == 1 ? Lang::get("app.set inactive"): Lang::get("app.set active") !!}</a>
					<a href="{!! url('/bank/form/'.Crypt::encrypt($data->id)) !!}" class="btn btn-primary btn-rounded btn-md"><i class="fa fa-pencil"></i> {!! Lang::get("app.edit") !!}</a>
					@endif
					<a href="{!! url('/bank') !!}" class="btn btn-primary btn-rounded btn-md"><i class="fa fa-undo"></i> {!! Lang::get("app.back") !!}</a>
                </div>
			</div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
	  
	<div class="row">
		<div class="col-lg-6">
			<div class="white-box">
				<table class="table">
					<tbody>
						<tr>
							<td class="col-md-3">{!! Lang::get('app.name') !!}</td>
							<td class="col-md-9">{!! $data->name !!}</td>
						</tr>
						<tr>
							<td class="col-md-3">{!! Lang::get('app.country') !!}</td>
							<td class="col-md-9">{!! $data->country !!}</td>
						</tr>
						
					</tbody>
				</table>
				
				
			</div>
		</div>
		<div class="col-lg-6">
			<div class="white-box">
				<table class="table">
					<tbody>
						<tr>
							<td class="col-md-3">{!! Lang::get('app.description') !!}</td>
							<td class="col-md-9">{!! $data->description !!}</td>
						</tr>
						
					</tbody>
				</table>
				
				
			</div>
		</div>
	</div>
@endsection