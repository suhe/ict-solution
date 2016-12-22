@extends('ict-backend-theme::main_layout',['title' => $page_title])
@section('content')
	<div class="row bg-title">
        <div class="col-lg-6">
          <h4 class="page-title"> {!! $page_title !!}</h4>
        </div>
        <div class="col-lg-6">
			<div class="pull-right">
				<div class="btn-group">
					@if(Role::access('c','user'))
					<a href="{!! url('/user-group/form') !!}" class="btn btn-rounded btn-primary btn-md"><i class="fa fa-plus"></i> {!! Lang::get("app.create") !!}</a>
					@endif
					@if(Role::access('u','user'))
						@if($data->id!=1)
							<a href="{!! url('/user/do-publish/'.Crypt::encrypt($data->id)) !!}" class="btn btn-rounded btn-primary btn-md"><i class="fa fa-flag"></i> {!! isset($data) && $data->is_active == 1 ? Lang::get("app.set inactive"): Lang::get("app.set active") !!}</a>
							<a href="{!! url('/user/form/'.Crypt::encrypt($data->id)) !!}" class="btn btn-primary btn-rounded btn-md"><i class="fa fa-pencil"></i> {!! Lang::get("app.edit") !!}</a>
						@endif
					@endif
					<a href="{!! url('/user') !!}" class="btn btn-primary btn-rounded btn-md"><i class="fa fa-undo"></i> {!! Lang::get("app.back") !!}</a>
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
							<td class="col-md-3">{!! Lang::get('app.first name') !!}</td>
							<td class="col-md-9">{!! $data->first_name !!}</td>
						</tr>
						<tr>
							<td class="col-md-3">{!! Lang::get('app.last name') !!}</td>
							<td class="col-md-9">{!! $data->last_name !!}</td>
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
							<td class="col-md-3">{!! Lang::get('app.group') !!}</td>
							<td class="col-md-9">{!! $data->user_group !!}</td>
						</tr>
						<tr>
							<td class="col-md-3">{!! Lang::get('app.email') !!}</td>
							<td class="col-md-9">{!! $data->email !!}</td>
						</tr>	
						@if(Role::access('u','user'))
						<tr>
							<td class="col-md-3">{!! Lang::get('app.password') !!}</td>
							<td class="col-md-9"><a class="btn btn-default" href="{!! url('/user/reset-password/'.(Crypt::encrypt($data->id))) !!}">{!! Lang::get('app.reset password') !!}</a></td>
						</tr>	
						@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection