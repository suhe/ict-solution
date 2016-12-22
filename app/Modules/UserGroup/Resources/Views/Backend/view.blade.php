@extends('ict-backend-theme::main_layout',['title' => $page_title])
@section('content')
	<div class="row bg-title">
        <div class="col-lg-6">
          <h4 class="page-title"> {!! $page_title !!}</h4>
        </div>
        <div class="col-lg-6">
			<div class="pull-right">
				<div class="btn-group">
					@if(App::access('c','user-group'))
					<a href="{!! url('/user-group/form') !!}" class="btn btn-rounded btn-primary btn-md"><i class="fa fa-plus"></i> {!! Lang::get("app.create") !!}</a>
					@endif
					@if(App::access('u','user-group'))
						@if($data->id!=1)
							<a href="{!! url('/user-group/do-publish/'.Crypt::encrypt($data->id)) !!}" class="btn btn-rounded btn-primary btn-md"><i class="fa fa-flag"></i> {!! isset($data) && $data->is_active == 1 ? Lang::get("app.set inactive"): Lang::get("app.set active") !!}</a>
							<a href="{!! url('/user-group/form/'.Crypt::encrypt($data->id)) !!}" class="btn btn-primary btn-rounded btn-md"><i class="fa fa-pencil"></i> {!! Lang::get("app.edit") !!}</a>
						@endif
					@endif
					<a href="{!! url('/user-group') !!}" class="btn btn-primary btn-rounded btn-md"><i class="fa fa-undo"></i> {!! Lang::get("app.back") !!}</a>
                </div>
			</div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
	  
	<div class="row">
		<div class="col-lg-5">
			<div class="white-box">
				<table class="table">
					<tbody>
						<tr>
							<td class="col-md-3">{!! Lang::get('app.name') !!}</td>
							<td class="col-md-9">{!! $data->name !!}</td>
						</tr>
						<tr>
							<td class="col-md-3">{!! Lang::get('app.description') !!}</td>
							<td class="col-md-9">{!! $data->description !!}</td>
						</tr>	
						
					</tbody>
				</table>
				
			</div>
		</div>
		<div class="col-lg-7">
			<div class="white-box">
				<table class="table table-striped">
					<thead>
						<tr>
							<th class="col-md-1"> {!! Lang::get('app.no') !!} </th>
							<th class="col-md-3"> {!! Lang::get('app.name') !!} </th>
							<th class="col-md-3"> {!! Lang::get('app.slug') !!} </th>
							<th class="col-md-1 text-center"> {!! Lang::get('app.read') !!} </th>
							<th class="col-md-1 text-center"> {!! Lang::get('app.create') !!} </th>
							<th class="col-md-1 text-center"> {!! Lang::get('app.update') !!} </th>
							<th class="col-md-1 text-center"> {!! Lang::get('app.delete') !!} </th>
						</tr>
					</thead>
					<tbody>
						@php
							$i=1;
						@endphp
						@foreach($modules as $key => $module)
							<tr>
								<td> {!! $i !!} </td>
								<td> {!! $module['name'] !!} </td>
								<td> {!! $module['slug'] !!} </td>
								<td class="text-center"> {!! Role::access('r',$module['slug'],$data->id) ? "<i class='fa fa-check'></i>" : "<i class='fa fa-close'></i>" !!}</td> 
								<td class="text-center"> {!! Role::access('c',$module['slug'],$data->id) ? "<i class='fa fa-check'></i>" : "<i class='fa fa-close'></i>" !!}</td>
								<td class="text-center"> {!! Role::access('u',$module['slug'],$data->id) ? "<i class='fa fa-check'></i>" : "<i class='fa fa-close'></i>" !!}</td>	
								<td class="text-center"> {!! Role::access('d',$module['slug'],$data->id) ? "<i class='fa fa-check'></i>" : "<i class='fa fa-close'></i>" !!}</td>		
							</tr>
						@php
							$i=$i+1;
						@endphp	
						@endforeach
					</tbody>
				</table>	
			</div>
		</div>
	</div>
@endsection