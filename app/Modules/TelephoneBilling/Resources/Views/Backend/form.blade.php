@extends('ict-backend-theme::main_layout',['title' => $page_title])
@section('content')
	{!! Form::open(['url' => '#','role' => 'form','id'=>'update_form','class' => 'form-material form-horizontal']) !!}
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
						{!! Form::select('customer_id',[],isset($data) ? $data->customer_id : null,['class' => 'form-control form-control-line','id'=>'customer_id','placeholder'=>lang::get('app.customer id'),'maxlength' => 100]) !!}
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-md-12">{!! Lang::get('app.payment method') !!} <span class="help"> *</span></label>
                    <div class="col-md-12">
						{!! Form::select('payment_method',App\Modules\PaymentMethod\PaymentMethod::lists(),isset($data) ? $data->payment_method : null,['class' => 'form-control form-control-line','id'=>'payment_method_id','placeholder'=>lang::get('app.payment method'),'maxlength' => 100]) !!}
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
						{!! Form::text('service_periode',isset($data) ? $data->service_periode : null,['class' => 'form-control form-control-line','id'=>'service_periode','placeholder'=>lang::get('app.service periode'),'maxlength' => 12]) !!}
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
							<table class="table table-striped">
								<thead>
									<tr>
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