@extends('ict-backend-theme::main_layout',['title' => $page_title])
@section('content')
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h4 class="page-title"> {!! $page_title !!}</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			@if(Role::access('c','telephone-billing'))
				<a href="{!! url('/telephone-billing/form') !!}" class="btn btn-primary btn-rounded pull-right m-l-20 btn-sm  hidden-xs hidden-sm waves-effect waves-light"><i class="fa fa-pencil"></i> {!! Lang::get('app.create') !!}</a>
			@endif
			{!! Form::open(['url' => '/telephone-billing','method'=>'GET','class'=>'form-inline pull-right']) !!}
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
							<th class="text-center col-md-1">{!! Lang::get('app.no') !!}</th>
							<th class="text-center col-md-2">>@sortablelink('number', Lang::get('app.number'))</th>
							<th class="text-center col-md-1">>@sortablelink('print date', Lang::get('app.print date'))</th></th>
							<th class="text-center col-md-1">>@sortablelink('due_date', Lang::get('app.due date'))</th></th>
							<th class="col-md-5">>@sortablelink('customer_id', Lang::get('app.customer'))</th></th>
							<th class="col-md-1">>@sortablelink('total_bill', Lang::get('app.total bill'))</th></th>
							<th class="text-center col-md-1">{!! Lang::get('app.edit') !!}</th>
						 </tr>
					</thead>
					<tbody>
						@foreach($telephone_billings as $key => $row)
							<tr class="row-{!! $row->id !!}">
								<td class="text-center">{!! $key + 1 + Request::get('page') !!}</td>
								<td>{!! $row->number !!}</td>
								<td class="text-center">{!! $row->print_date !!}</td>
								<td class="text-center">{!! $row->due_date !!}</td>
								<td>{!! $row->customer_name !!}</td>
								<td class="text-right">{!! number_format($row->total_bill,2) !!}</td>
								<td class="text-center">
									<div class="btn-group dropup m-r-10">
										<button class="btn btn-sm btn-primary btn-rounded dropdown-toggle waves-effect waves-light" type="button" data-toggle="dropdown">
											<i class="fa fa-pencil"> {!! Lang::get('app.edit') !!}</i>
											<span class="caret"></span>
										</button>
										<ul class="dropdown-menu">
											<li><a href="{!! url('/telephone-billing/view/'.Crypt::encrypt($row->id)) !!}"> {!! Lang::get('app.view') !!}</a></li>
											@if(Role::access('u','telephone-billing'))
											<li><a href="{!! url('/telephone-billing/form/'.Crypt::encrypt($row->id)) !!}"> {!! Lang::get('app.edit') !!}</a></li>
											@endif
											@if(Role::access('d','telephone-billing'))
											<li><a href="#" id="{!! Crypt::encrypt($row->id) !!}" class="delete"> {!! Lang::get('app.delete') !!}</a></li>
											@endif
										</ul>
									</div>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				{!! $telephone_billings->appends(Request::except('page'))->render() !!}
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
					url   : "{!! url('/telephone-billing/do-delete') !!}",
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