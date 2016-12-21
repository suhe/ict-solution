@extends('ict-backend-theme::main_layout',['title' => $page_title])
@section('content')
	{!! Form::open(['url' => '/customer/do-update','role' => 'form','id'=>'update_form','class' => 'form-material form-horizontal']) !!}
	{!! Form::hidden('id', isset($data) ?  Crypt::encrypt($data->id) : null, ['id' => 'id']) !!}
	<div class="row bg-title">
        <div class="col-lg-6">
          <h4 class="page-title"> {!! $page_title !!}</h4>
        </div>
        <div class="col-lg-6">
			<div class="pull-right">
				<div class="btn-group">
					<button class="btn btn-rounded btn-primary btn-md" type="submit"><i class="fa fa-save"></i> {!! Lang::get("app.submit") !!}</button>
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
                    <label class="col-md-12">{!! Lang::get('app.customer id') !!} <span class="help"> *</span></label>
                    <div class="col-md-12">
						{!! Form::text('identity_number',isset($data) ? $data->identity_number : null,['class' => 'form-control form-control-line','id'=>'identity_number','placeholder'=>lang::get('app.identity number'),'maxlength' => 100]) !!}
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-md-12">{!! Lang::get('app.name') !!} <span class="help"> *</span></label>
                    <div class="col-md-12">
						{!! Form::text('name',isset($data) ? $data->name : null,['class' => 'form-control form-control-line','id'=>'name','placeholder'=>lang::get('app.name'),'maxlength' => 100]) !!}
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-md-12">{!! Lang::get('app.address') !!} <span class="help"> *</span></label>
                    <div class="col-md-12">
						{!! Form::textarea('address',isset($data) ? $data->address : null,['rows'=>3,'class' => 'form-control form-control-line','id'=>'address','placeholder'=>lang::get('app.address'),'maxlength' => 255]) !!}
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-md-12">{!! Lang::get('app.city') !!} <span class="help"> *</span></label>
                    <div class="col-md-12">
						{!! Form::select('city_id',[],isset($data)?$data->city_id:null, ['class' => 'form-control form-control-line input-md','id'=>'city_id']) !!}
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-md-12">{!! Lang::get('app.zip code') !!} <span class="help"> *</span></label>
                    <div class="col-md-12">
						{!! Form::text('zip_code',isset($data) ? $data->zip_code : null,['class' => 'form-control form-control-line','id'=>'zip_code','placeholder'=>lang::get('app.zip code'),'maxlength' => 5]) !!}
                    </div>
                </div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="white-box">
				<div class="form-group">
                    <label class="col-md-12">{!! Lang::get('app.group') !!} <span class="help"> *</span></label>
                    <div class="col-md-12">
						{!! Form::select('customer_group_id',[],isset($data)?$data->customer_group_id:null, ['class' => 'form-control form-control-line input-md','id'=>'customer_group_id']) !!}
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-md-12">{!! Lang::get('app.contact person') !!} <span class="help"> *</span></label>
                    <div class="col-md-12">
						{!! Form::text('contact_person',isset($data) ? $data->contact_person : null,['class' => 'form-control form-control-line','id'=>'contact_person','placeholder'=>lang::get('app.position'),'maxlength' => 100]) !!}
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-md-12">{!! Lang::get('app.phone number') !!} <span class="help"> *</span></label>
                    <div class="col-md-12">
						{!! Form::text('phone_number',isset($data) ? $data->phone_number : null,['class' => 'form-control form-control-line','id'=>'phone_number','placeholder'=>lang::get('app.phone number'),'maxlength' => 18]) !!}
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-md-12">{!! Lang::get('app.position') !!} <span class="help"> *</span></label>
                    <div class="col-md-12">
						{!! Form::text('contact_position',isset($data) ? $data->contact_position : null,['class' => 'form-control form-control-line','id'=>'contact_position','placeholder'=>lang::get('app.position'),'maxlength' => 100]) !!}
                    </div>
                </div>
			</div>
		</div>
	</div>
	{!! Form::close() !!}
@endsection

@push('stylesheet')
	<link href="{!! Theme::asset('vendor/bootstrap-select2/css/select2.min.css') !!}" rel="stylesheet"/>
@endpush

@push('scripts')
<script src="{!! Theme::asset('vendor/bootstrap-select2/js/select2.min.js') !!}"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('select[name="city_id"]').select2({
		tags: false,
		multiple: false,
		minimumInputLength: 2,
		minimumResultsForSearch: 10,
		ajax: {
			async: false,
			url: "{!! url('/city/lists') !!}",
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
	$.getJSON("{!! url('/customer/get/city') !!}",{id:"{!! (isset($data) ? Crypt::encrypt($data->id) : 0) !!}"}, function(result) {
		var options = $('select[name="city_id"]');
		options.empty();
		$.each(result, function(key,item) {
			options.append('<option value="' + item.id + '">' + item.name + '</option>');
		});
		
	});
	
	$('select[name="customer_group_id"]').select2({
		tags: false,
		multiple: false,
		minimumInputLength: 2,
		minimumResultsForSearch: 10,
		ajax: {
			async: false,
			url: "{!! url('/customer-group/lists') !!}",
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
	
	//get customer group
	$.getJSON("{!! url('/customer/get/customer-group') !!}",{id:"{!! (isset($data) ? Crypt::encrypt($data->id) : 0) !!}"}, function(result) {
		var options = $('select[name="customer_group_id"]');
		options.empty();
		$.each(result, function(key,item) {
			options.append('<option value="' + item.id + '">' + item.name + '</option>');
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