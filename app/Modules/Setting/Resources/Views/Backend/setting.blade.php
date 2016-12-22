@extends('ict-backend-theme::main_layout',['title' => $page_title])
@section('content') 
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h4 class="page-title">{!! Lang::get('app.my profile') !!}</h4>
        </div>
        
    </div>
    <!-- /.row -->
    <div class="row">
		<div class="col-md-12 col-xs-12">
			<div class="white-box">
				<ul class="nav nav-tabs tabs customtab">
					<li class="active tab"><a href="#home" data-toggle="tab"> <span class="visible-xs"><i class="fa fa-home"></i></span> <span class="hidden-xs">{!! Lang::get('app.company') !!}</span> </a> </li>
					
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="home">
						{!! Form::open(['url' => '/setting/do-update/company','role' => 'form','id'=>'update_company_form','class' => 'form-material form-horizontal']) !!}
							<div class="form-group">
								<label class="col-md-12">{!! Lang::get('app.name') !!}</label>
								<div class="col-md-12">
									{!! Form::text('name',isset($company) ? $company->name : null,['class' => 'form-control form-control-line','id'=>'name','placeholder'=>lang::get('app.name'),'maxlength' => 100]) !!}
								</div>
							</div>
						  
							<div class="form-group">
								<label class="col-md-12">{!! Lang::get('app.npwp') !!} <span class="help"> *</span></label>
								<div class="col-md-12">
									{!! Form::text('last_name',isset($company) ? $company->npwp : null,['class' => 'form-control form-control-line','id'=>'last_name','placeholder'=>lang::get('app.last name'),'maxlength' => 100]) !!}
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-12">{!! Lang::get('app.address') !!} <span class="help"> *</span></label>
								<div class="col-md-12">
									{!! Form::textarea('address_1',isset($company) ? $company->address_1 : null,['rows'=>3,'class' => 'form-control form-control-line','id'=>'address_1','placeholder'=>lang::get('app.address'),'maxlength' => 255]) !!}
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-md-12">
									{!! Form::textarea('address_2',isset($company) ? $company->address_2 : null,['rows'=>3,'class' => 'form-control form-control-line','id'=>'address_2','placeholder'=>lang::get('app.address'),'maxlength' => 255]) !!}
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-12">{!! Lang::get('app.city') !!} <span class="help"> *</span></label>
								<div class="col-md-12">
									{!! Form::select('user_group_id',App\Modules\City\City::lists(),isset($company) ? $company->city_id : null,['class' => 'form-control form-control-line','id'=>'city_id']) !!}
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-md-12">
									{!! Form::text('zip_code',isset($company) ? $company->zip_code : null,['class' => 'form-control form-control-line','id'=>'zip_code','placeholder'=>lang::get('app.zip code'),'maxlength' => 5]) !!}
								</div>
							</div>
				
							<div class="form-group">
								<div class="col-sm-12">
									<button class="btn btn-success" type="submit">{!! Lang::get('app.update profile') !!}</button>
								</div>
							</div>
						{!! Form::close() !!}
					</div>
					
				</div>	
			</div>
		</div>
	</div>	
@endsection

@push('scripts')
<script src="{!! Theme::asset('vendor/bootstrap-select2/js/select2.min.js') !!}"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#update_company_form').on('submit', function(event) {
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
					
				}
			},
			error : function() {
				$(".help-block").remove();
				$("div#divLoading").removeClass('show');
			}
		});
		return false;
	});
	
	$('#update_password_form').on('submit', function(event) {
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