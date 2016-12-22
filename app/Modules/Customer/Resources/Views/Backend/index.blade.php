@extends('ict-backend-theme::main_layout',['title' => $page_title])
@section('content')
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h4 class="page-title"> {!! $page_title !!}</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			@if(Role::access('c','customer'))
				<a href="{!! url('/customer/form') !!}" class="btn btn-primary btn-rounded pull-right m-l-20 btn-sm  hidden-xs hidden-sm waves-effect waves-light"><i class="fa fa-pencil"></i> {!! Lang::get('app.create') !!}</a>
			@endif
			{!! Form::open(['url' => '/customer','method'=>'GET','class'=>'form-inline pull-right']) !!}
				<div class="form-group">
					<label>{!! Lang::get('app.search') !!}</label>
					{!! Form::text('query',Request::get('query'),['class' => 'form-control input-sm','id'=>'query','placeholder'=>lang::get('app.keyword'),'maxlength'=>100]) !!}
				</div>
				<button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> {!! Lang::get('app.search') !!}</button>
			{!! Form::close()!!}
        </div>
        <!-- /.col-lg-12 -->
    </div>
	  
	<div class="row">
		<div class="col-lg-12">
			<div class="white-box">
				<table class="table">
					<thead>
						<tr>
							<th>@sortablelink('identity_number', Lang::get('app.customer id'))</th>
							<th>@sortablelink('name', Lang::get('app.name'))</th>
							<th>@sortablelink('contact_person', Lang::get('app.contact person'))</th></th>
							<th>@sortablelink('city_id', Lang::get('app.city'))</th></th>
							<th class="text-center">{!! Lang::get('app.status') !!}</th>
							<th class="text-center">{!! Lang::get('app.edit') !!}</th>
						 </tr>
					</thead>
					<tbody>
						@foreach($customers as $key => $row)
							<tr class="row-{!! $row->id !!}">
								<td>{!! $row->identity_number !!}</td>
								<td>{!! $row->name !!}</td>
								<td>{!! $row->contact_person !!}</td>
								<td>{!! $row->city !!}</td>
								<td class="text-center">
									@if($row->is_active == 1)
										<center><i class="fa fa-check"></i></center>
									@else
										<center><i class="fa fa-close"></i></center>
									@endif
								</td>
								<td class="text-center">
									<div class="btn-group dropup m-r-10">
										<button class="btn btn-sm btn-primary btn-rounded dropdown-toggle waves-effect waves-light" type="button" data-toggle="dropdown">
											<i class="fa fa-pencil"> {!! Lang::get('app.edit') !!}</i>
											<span class="caret"></span>
										</button>
										<ul class="dropdown-menu">
											<li><a href="{!! url('/customer/view/'.Crypt::encrypt($row->id)) !!}"> {!! Lang::get('app.view') !!}</a></li>
											@if(Role::access('u','customer'))
											<li><a href="{!! url('/customer/form/'.Crypt::encrypt($row->id)) !!}"> {!! Lang::get('app.edit') !!}</a></li>
											@endif
											@if(Role::access('d','customer'))
											<li><a href="#" id="{!! Crypt::encrypt($row->id) !!}" class="delete"> {!! Lang::get('app.delete') !!}</a></li>
											@endif
										</ul>
									</div>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				{!! $customers->appends(Request::except('page'))->render() !!}
			</div>
		</div>
	</div>
@endsection

@push("scripts")
<script type="text/javascript">
$(function() {
    $('.delete').on('click', function(event) {
		event.preventDefault();
		$("div#divLoading").addClass('show');
		var id = $(this).attr("id");
		$.confirm({
			title: '{!! Lang::get("app.confirm") !!}',
			content: '{!! Lang::get("info.confirm delete") !!}',
			confirm: function(){
				$.ajax({
					type  : "post",
					url   : "{!! url('/customer/do-delete') !!}",
					data  : {id:id},
					dataType: "json",
					cache : false,
					beforeSend: function(xhr) {xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf_token"]').attr('content'))},
					success : function(response) {
						$("div#divLoading").removeClass('show');
							if(response.success == true) {
								$(".row-" + response.id).remove();
							}

						$.alert(response.message);
					},
					error : function() {
						$("div#divLoading").removeClass('show');
					}
				});
			},
			cancel: function(){
				$("div#divLoading").removeClass('show');
			}
		});
    });
});
</script>
@endpush