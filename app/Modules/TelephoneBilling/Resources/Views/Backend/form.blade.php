@extends('ict-backend-theme::main_layout',['title' => $page_title])
@section('content')
	{!! Form::open(['url' => 'telephone-billing/do-update','role' => 'form','id'=>'update_form','class' => 'form-material form-horizontal']) !!}
	{!! Form::hidden('id', isset($data) ?  Crypt::encrypt($data->id) : null, ['id' => 'id']) !!}
	<div class="row bg-title">
        <div class="col-lg-6">
          <h4 class="page-title"> {!! $page_title !!}</h4>
        </div>
        <div class="col-lg-6">
			<div class="pull-right">
				<div class="btn-group">
					@if(Role::access('u','telephone-billing'))
					<button class="btn btn-rounded btn-primary btn-md" type="submit"><i class="fa fa-save"></i> {!! Lang::get("app.submit") !!}</button>
					@endif
					<a href="{!! url()->previous() !!}" class="btn btn-primary btn-rounded btn-md"><i class="fa fa-undo"></i> {!! Lang::get("app.back") !!}</a>
                </div>
			</div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
	  
	<div class="row">
		<div class="col-lg-6">
			<div class="white-box">
				<div class="form-group">
                    <label class="col-md-12">{!! Lang::get('app.customer name') !!} <span class="help"> *</span></label>
                    <div class="col-md-12">
						{!! Form::text('customer_name',isset($data) ? $data->customer_name : null,['readonly'=>true,'class' => 'form-control form-control-line','id'=>'customer_name','placeholder'=>lang::get('app.customer name'),'maxlength' => 100]) !!}
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-md-12">{!! Lang::get('app.address') !!} <span class="help"> *</span></label>
                    <div class="col-md-12">
						{!! Form::textarea('customer_address',isset($data) ? $data->customer_address : null,['readonly'=>true,'rows'=>3,'class' => 'form-control form-control-line','id'=>'customer_address','placeholder'=>lang::get('app.address'),'maxlength' => 255]) !!}
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-md-12">{!! Lang::get('app.city') !!} <span class="help"> *</span></label>
                    <div class="col-md-12">
						{!! Form::text('customer_city',isset($data) ? $data->customer_city : null,['readonly'=>true,'class' => 'form-control form-control-line','id'=>'customer_city','placeholder'=>lang::get('app.city'),'maxlength' => 100]) !!}
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-md-12">{!! Lang::get('app.zip code') !!} <span class="help"> *</span></label>
                    <div class="col-md-12">
						{!! Form::text('customer_zip_code',isset($data) ? $data->customer_zip_code : null,['class' => 'form-control form-control-line','id'=>'zip_code','placeholder'=>lang::get('app.zip code'),'maxlength' => 5]) !!}
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-md-12">{!! Lang::get('app.contact person') !!} <span class="help"> *</span></label>
                    <div class="col-md-12">
						{!! Form::text('customer_contact_person',isset($data) ? $data->contact_person : null,['class' => 'form-control form-control-line','id'=>'contact_person','placeholder'=>lang::get('app.contact person'),'maxlength' => 100]) !!}
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-md-12">{!! Lang::get('app.position') !!} <span class="help"> *</span></label>
                    <div class="col-md-12">
						{!! Form::text('customer_contact_position',isset($data) ? $data->contact_position : null,['class' => 'form-control form-control-line','id'=>'contact_position','placeholder'=>lang::get('app.position'),'maxlength' => 100]) !!}
                    </div>
                </div>
				
			</div>
		</div>
		<div class="col-lg-6">
			<div class="white-box">
				<div class="form-group">
                    <label class="col-md-12">{!! Lang::get('app.invoice number') !!} <span class="help"> *</span></label>
                    <div class="col-md-12">
						{!! Form::text('invoice_number',isset($data) ? $data->number : Lang::get('app.auto generated'),['readonly'=>true,'class' => 'form-control form-control-line','id'=>'invoice_number','placeholder'=>lang::get('app.invoice number'),'maxlength' => 100]) !!}
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-md-12">{!! Lang::get('app.customer id') !!} <span class="help"> *</span></label>
                    <div class="col-md-12">
						{!! Form::select('customer_id',[],isset($data) ? $data->customer_id : null,['class' => 'form-control form-control-line','id'=>'customer_id','placeholder'=>lang::get('app.customer id')]) !!}
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-md-12">{!! Lang::get('app.payment method') !!} <span class="help"> *</span></label>
                    <div class="col-md-12">
						{!! Form::select('payment_method_id',App\Modules\PaymentMethod\PaymentMethod::lists(),isset($data) ? $data->payment_method_id : null,['class' => 'form-control form-control-line','id'=>'payment_method_id','placeholder'=>lang::get('app.payment method')]) !!}
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-md-12">{!! Lang::get('app.payment frequency') !!} <span class="help"> *</span></label>
                    <div class="col-md-12">
						{!! Form::select('payment_frequency',['BULANAN'=>"BULANAN",'TAHUNAN'=>"TAHUNAN"],isset($data) ? $data->payment_frequency : null,['class' => 'form-control form-control-line','id'=>'payment_frequency','placeholder'=>lang::get('app.payment frequency'),'maxlength' => 100]) !!}
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-md-12">{!! Lang::get('app.print date') !!} <span class="help"> *</span></label>
                    <div class="col-md-12">
						{!! Form::text('print_date',isset($data) ? $data->print_date : null,['class' => 'form-control form-control-line','id'=>'print_date','placeholder'=>lang::get('app.print date'),'maxlength' => 12]) !!}
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-md-12">{!! Lang::get('app.due date') !!} <span class="help"> *</span></label>
                    <div class="col-md-12">
						{!! Form::text('due_date',isset($data) ? $data->due_date : null,['class' => 'form-control form-control-line','id'=>'due_date','placeholder'=>lang::get('app.print date'),'maxlength' => 12]) !!}
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-md-12">{!! Lang::get('app.service periode') !!} <span class="help"> *</span></label>
                    <div class="col-md-12">
						{!! Form::text('service_period',isset($data) ? $data->service_period : null,['class' => 'form-control form-control-line','id'=>'service_period','placeholder'=>lang::get('app.service periode'),'maxlength' => 12]) !!}
                    </div>
                </div>
			</div>
		</div>
	</div>
	
	<!-- /.row -->
    <div class="row">
		<div class="col-md-12 col-xs-12">
			<div class="white-box">
				<ul class="nav nav-tabs tabs customtab">
					<li class="active tab"><a href="#home" data-toggle="tab"> <span class="visible-xs"><i class="fa fa-home"></i></span> <span class="hidden-xs">{!! Lang::get('app.detail') !!}</span> </a> </li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="home">
						<div class="table-responsive" id="item_details">
							<table id="table_items" class="table table-striped">
								<thead>
									<tr>
										<th class="col-md-1 text-center">{!! Lang::get('app.edit') !!}</th>
										<th class="col-md-1">{!! Lang::get('app.number') !!}</th>
										<th class="col-md-1">{!! Lang::get('app.period') !!}</th>
										<th class="col-md-1 text-center">{!! Lang::get('app.abodemen') !!}</th>
										<th class="col-md-1 text-center">{!! Lang::get('app.japati') !!}</th>
										<th class="col-md-1 text-center">{!! Lang::get('app.mobile') !!}</th>
										<th class="col-md-1 text-center">{!! Lang::get('app.local') !!}</th>
										<th class="col-md-1 text-center">{!! Lang::get('app.sljj') !!}</th>
										<th class="col-md-1 text-center">{!! Lang::get('app.sli 007') !!}</th>
										<th class="col-md-1 text-center">{!! Lang::get('app.telkom global 017') !!}</th>
										<th class="col-md-1 text-center">{!! Lang::get('app.surcharge') !!}</th>
										<th class="col-md-1 text-center">{!! Lang::get('app.ppn') !!}</th>
										<th class="col-md-1 text-center">{!! Lang::get('app.subtotal') !!}</th>
									</tr>
								</thead>
								<tbody>
									@foreach(Cart::instance('line-form')->content() as $row)
									<tr id="{!! $row->rowId !!}">
										<td class='text-center'> <span> <a class="line_edit" id="{!! $row->rowId !!}" href="#" ><i class='fa fa-pencil'></i> </a> &nbsp;  <a class='line_delete' id="{!! $row->rowId !!}" href='#'><i class='fa fa-trash'></i> </a></span></td>
										<td class="phone_number">{!! $row->name !!}</td>
										<td class="period">{!! $row->id !!}</td>
										<td class="abodemen text-right">{!! number_format($row->options->abodemen,2) !!}</td>
										<td class="japati text-right">{!! number_format($row->options->japati,2) !!}</td>
										<td class="mobile text-right">{!! number_format($row->options->mobile,2) !!}</td>
										<td class="local text-right">{!! number_format($row->options->local,2) !!}</td>
										<td class="sljj text-right">{!! number_format($row->options->sljj,2) !!}</td>
										<td class="sli_007 text-right">{!! number_format($row->options->sli_007,2) !!}</td>
										<td class="telkom_global_017 text-right">{!! number_format($row->options->telkom_global_017,2) !!}</td>
										<td class="surcharge text-right">{!! number_format($row->options->surcharge_total,2) !!}</td>
										<td class="ppn text-right">{!! number_format($row->options->ppn_total,2) !!}</td>
										<td class="subtotal text-right">{!! number_format($row->options->subtotal,2) !!}</td>
									</tr>
									@endforeach	
									
									<tr class="first_line">
										<td colspan="7 text-right">
											@if(Role::access('c','telephone-billing'))
											<a href="#" class="add-line btn btn-primary"> <i class="fa fa-pencil"></i> {!! Lang::get('app.add line') !!}</a>
											@endif
										</td>		
									</tr>
								</tbody>
								<tfoot>
									
								</tfoot>
							</table>
						</div>
					
					</div>
				</div>	
			</div>
		</div>
	</div>	
	{!! Form::close() !!}
	
	@include('telephone-billing::Backend.line-form')
	
@endsection

@push('stylesheet')
	<link href="{!! Theme::asset('vendor/bootstrap-select2/css/select2.min.css') !!}" rel="stylesheet"/>
	<link href="{!! Theme::asset('vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') !!}" rel="stylesheet"/>
@endpush

@push('scripts')
<script src="{!! Theme::asset('vendor/bootstrap-select2/js/select2.min.js') !!}"></script>
<script src="{!! Theme::asset('vendor/eonasdan-datetimepicker/build/js/moment.min.js') !!}"></script>
<script src="{!! Theme::asset('vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') !!}"></script>
<script type="text/javascript">
$(document).ready(function(){
	jQuery('#print_date,#due_date').datepicker({
		format: 'dd/mm/yyyy',
		autoclose: true,
        todayHighlight: true
	});
	$('select[name="customer_id"]').select2({
		tags: false,
		multiple: false,
		minimumInputLength: 2,
		minimumResultsForSearch: 10,
		ajax: {
			async: false,
			url: "{!! url('/customer/lists') !!}",
			dataType: "json",
			type: "GET",
			data: function (params) {
				var queryParameters = {
					term: params.term
				}
				return queryParameters;
			},
			processResults: function (data) {
				return {
					results: $.map(data, function (item) {
						return {
							text: item.name,
							id : item.id
						}
					})	
				};
			}
		}
	});
	
	//get city
	$.getJSON("{!! url('/telephone-billing/get/customer') !!}",{id:"{!! (isset($data) ? Crypt::encrypt($data->id) : 0) !!}"}, function(result) {
		var options = $('select[name="customer_id"]');
		options.empty();
		$.each(result, function(key,item) {
			options.append('<option value="' + item.id + '">' + item.name + '</option>');
		});
		
	});
	
	$('select[name="customer_id"]').on('change', function(event) {
		var id = $(this).val();
		$.getJSON("{!! url('/customer/view-json') !!}",{id:id}, function(results) {
			if(results.success == true) {
				$('input[name="customer_name"]').val(results.customer_name);
				$('textarea[name="customer_address"]').val(results.customer_address);
				$('input[name="customer_city"]').val(results.customer_city);
				$('input[name="customer_zip_code"]').val(results.customer_zip_code);
				$('input[name="customer_contact_person"]').val(results.customer_contact_person);
				$('input[name="customer_contact_position"]').val(results.customer_contact_position);
			} else {
				$('input[type="text"]').val("");
				$('input[type="textarea"]').val("");
			}
		});
	});
	
	$(".add-line").on('click', function(event){
		event.preventDefault();
		$('#line-form').modal('show');
		$('#line-form #id').val(response.rowId);	
		$('#line-form #phone_number').val("");
		$('#line-form #period').val("");
		$('#line-form #abodemen').val("0");
		$('#line-form #japati').val("0");
		$('#line-form #mobile').val("0");
		$('#line-form #local').val("0");
		$('#line-form #sljj').val("0");
		$('#line-form #sli_007').val("0");
		$('#line-form #telkom_global_017').val("0");
		$('#line-form #surcharge').val("15");
		$('#line-form #ppn').val("10");	
	});
	
	//table_items edit
	$("#table_items").on('click', '.line_edit', function(event) {
		event.preventDefault();
		$('#line-form').modal('show');
		$("div#modalLoading").addClass('show');
		var id = $(this).attr("id");
		$.ajax({
			type  : "post",
			url   : "{!! url('telephone-billing/view-line') !!}",
			data  : {id : id},
			dataType: "json",
			cache : false,
			beforeSend: function(xhr) {xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf_token"]').attr('content'))},
			success : function(response) {
				if(response.success == true) {
					$('#line-form #id').val(response.rowId);	
					$('#line-form #phone_number').val(response.phone_number);
					$('#line-form #period').val(response.period);
					$('#line-form #abodemen').val(response.abodemen);
					$('#line-form #japati').val(response.japati);
					$('#line-form #mobile').val(response.mobile);
					$('#line-form #local').val(response.local);
					$('#line-form #sljj').val(response.sljj);
					$('#line-form #sli_007').val(response.sli_007);
					$('#line-form #telkom_global_017').val(response.telkom_global_017);
					$('#line-form #surcharge').val(response.surcharge_total);
					$('#line-form #ppn').val(response.ppn_total);
				}
				
				$("div#modalLoading").removeClass('show');

                                
			},
            error : function() {
				$("div#divLoading").removeClass('show');
            }
        });
		return false;
	});
			
	//table_items delete
	$("#table_items").on('click', '.line_delete', function(event){
		event.preventDefault();
		var id = $(this).attr("id");
		var container = $(this);
		$("div#divLoading").addClass('show');
		$.confirm({
			title: '{!! Lang::get("app.confirm") !!}',
			content: '{!! Lang::get("info.confirm delete") !!}',
            confirm: function(){
				$.ajax({
					type  : "post",
					url   : "{!! url('telephone-billing/do-delete/line') !!}",
                    data  : {id : id},
                    dataType: "json",
					cache : false,
					beforeSend: function(xhr) {xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf_token"]').attr('content'))},
					success : function(response) {
						$("div#divLoading").removeClass('show');
                        if(response.success == true) {
							$(container).parent().parent().parent().remove();
							$.alert(response.message);
                        }  
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
	
	$('#update_form').on('submit', function(event) {
		event.preventDefault();
		$("div#divLoading").addClass('show'); //show loading
		$.ajax({
			type : $(this).attr('method'),
			url : $(this).attr('action'),
			data : $(this).serialize(),
			dataType : "json",
			cache : false,
			beforeSend : function() { console.log($(this).serialize());},
			success : function(response) {
				$(".help-block").remove();
				$("div#divLoading").removeClass('show');
				if(response.success == false) {
					$.each(response.message, function( index,message) {
						var element = $('<p>' + message + '</p>').attr({'class' : 'help-block text-danger'}).css({display: 'none'});
						$('#'+index).after(element);
						$(element).fadeIn();
					});
				} else {
					$.alert(response.message);
					window.location = response.redirect;
				}
			},
			error : function() {
				$(".help-block").remove();
				$("div#divLoading").removeClass('show');
			}
		});
		return false;
	});
});	
</script>	
@endpush