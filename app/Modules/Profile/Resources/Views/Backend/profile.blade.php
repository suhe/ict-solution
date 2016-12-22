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
					<li class="active tab"><a href="#home" data-toggle="tab"> <span class="visible-xs"><i class="fa fa-home"></i></span> <span class="hidden-xs">{!! Lang::get('app.personal information') !!}</span> </a> </li>
					<li class="tab"><a href="#change_password" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="fa fa-cog"></i></span> <span class="hidden-xs">{!! Lang::get('app.change password') !!}</span> </a> </li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="home">
						{!! Form::open(['url' => '/profile/do-update','role' => 'form','id'=>'update_profile_form','class' => 'form-material form-horizontal']) !!}
							<div class="form-group">
								<label class="col-md-12">{!! Lang::get('app.first name') !!}</label>
								<div class="col-md-12">
									{!! Form::text('first_name',isset($data) ? $data->first_name : null,['class' => 'form-control form-control-line','id'=>'first_name','placeholder'=>lang::get('app.first name'),'maxlength' => 100]) !!}
								</div>
							</div>
						  
							<div class="form-group">
								<label class="col-md-12">{!! Lang::get('app.last name') !!} <span class="help"> *</span></label>
								<div class="col-md-12">
									{!! Form::text('last_name',isset($data) ? $data->last_name : null,['class' => 'form-control form-control-line','id'=>'last_name','placeholder'=>lang::get('app.last name'),'maxlength' => 100]) !!}
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-12">{!! Lang::get('app.group') !!} <span class="help"> *</span></label>
								<div class="col-md-12">
									{!! Form::text('user_group',isset($data) ? $data->user_group : null,['readonly'=>true,'class' => 'form-control form-control-line','id'=>'user_group','placeholder'=>lang::get('app.user group'),'maxlength' => 100]) !!}
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-12">{!! Lang::get('app.email') !!} <span class="help"> *</span></label>
								<div class="col-md-12">
									{!! Form::text('email',isset($data) ? $data->email : null,['readonly'=>true,'class' => 'form-control form-control-line','id'=>'email','placeholder'=>lang::get('app.email'),'maxlength' => 100]) !!}
								</div>
							</div>
				
							<div class="form-group">
								<div class="col-sm-12">
									<button class="btn btn-success" type="submit">{!! Lang::get('app.update profile') !!}</button>
								</div>
							</div>
						{!! Form::close() !!}
					</div>
					<div class="tab-pane" id="change_password">
						{!! Form::open(['url' => '/profile/password/do-update','role' => 'form','id'=>'update_password_form','class' => 'form-material form-horizontal']) !!}
							<div class="form-group">
								<label class="col-md-12">{!! Lang::get('app.password') !!} <span class="help"> *</span></label>
								<div class="col-md-12">
									{!! Form::password('password',['class' => 'form-control form-control-line','id'=>'password','placeholder'=>lang::get('app.password'),'maxlength' => 18]) !!}
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-12">{!! Lang::get('app.confirm password') !!} <span class="help"> *</span></label>
								<div class="col-md-12">
									{!! Form::password('confirm_password',['class' => 'form-control form-control-line','id'=>'confirm_password','placeholder'=>lang::get('app.confirm password'),'maxlength' => 18]) !!}
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12">
									<button class="btn btn-success" type="submit">{!! Lang::get('app.change password') !!}</button>
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
	$('#update_profile_form').on('submit', function(event) {
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