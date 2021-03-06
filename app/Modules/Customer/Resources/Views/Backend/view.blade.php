@extends('ict-backend-theme::main_layout',['title' => $page_title])
@section('content')
	<div class="row bg-title">
        <div class="col-lg-6">
          <h4 class="page-title"> {!! $page_title !!}</h4>
        </div>
        <div class="col-lg-6">
			<div class="pull-right">
				<div class="btn-group">
					@if(Role::access('c','customer'))
					<a href="{!! url('/customer/form') !!}" class="btn btn-rounded btn-primary btn-md"><i class="fa fa-plus"></i> {!! Lang::get("app.create") !!}</a>
					@endif
					@if(Role::access('u','customer'))
					<a href="{!! url('/customer/do-publish/'.Crypt::encrypt($data->id)) !!}" class="btn btn-rounded btn-primary btn-md"><i class="fa fa-flag"></i> {!! isset($data) && $data->is_active == 1 ? Lang::get("app.set inactive"): Lang::get("app.set active") !!}</a>
					<a href="{!! url('/customer/form/'.Crypt::encrypt($data->id)) !!}" class="btn btn-primary btn-rounded btn-md"><i class="fa fa-pencil"></i> {!! Lang::get("app.edit") !!}</a>
					@endif
					<a href="{!! url('/customer') !!}" class="btn btn-primary btn-rounded btn-md"><i class="fa fa-undo"></i> {!! Lang::get("app.back") !!}</a>
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
							<td class="col-md-3">{!! Lang::get('app.customer id') !!}</td>
							<td class="col-md-9">{!! $data->identity_number !!}</td>
						</tr>
						<tr>
							<td class="col-md-3">{!! Lang::get('app.name') !!}</td>
							<td class="col-md-9">{!! $data->name !!}</td>
						</tr>
						<tr>
							<td class="col-md-3">{!! Lang::get('app.building address') !!}</td>
							<td class="col-md-9">{!! $data->building_address !!}</td>
						</tr>
						<tr>
							<td class="col-md-3">{!! Lang::get('app.address') !!}</td>
							<td class="col-md-9">{!! $data->address !!}</td>
						</tr>	
						<tr>
							<td class="col-md-3">{!! Lang::get('app.city') !!}</td>
							<td class="col-md-9">{!! $data->city !!}</td>
						</tr>	
						<tr>
							<td class="col-md-3">{!! Lang::get('app.zip code') !!}</td>
							<td class="col-md-9">{!! $data->zip_code !!}</td>
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
							<td class="col-md-9">{!! $data->customer_group !!}</td>
						</tr>
						<tr>
							<td class="col-md-3">{!! Lang::get('app.contact person') !!}</td>
							<td class="col-md-9">{!! $data->contact_person !!}</td>
						</tr>
						<tr>
							<td class="col-md-3">{!! Lang::get('app.phone number') !!}</td>
							<td class="col-md-9">{!! $data->phone_number !!}</td>
						</tr>
						<tr>
							<td class="col-md-3">{!! Lang::get('app.position') !!}</td>
							<td class="col-md-9">{!! $data->contact_position !!}</td>
						</tr>
						
					</tbody>
				</table>
				
				
			</div>
		</div>
	</div>
@endsection