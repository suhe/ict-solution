@extends('ict-backend-theme::main_layout',['title' => $page_title])
@section('content')
	{!! Form::open(['url' => '/user/do-update','role' => 'form','id'=>'update_form','class' => 'form-material form-horizontal']) !!}
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
                    <label class="col-md-12">{!! Lang::get('app.first name') !!} <span class="help"> *</span></label>
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
				
			</div>
		</div>
		<div class="col-lg-6">
			<div class="white-box">
				<div class="form-group">
                    <label class="col-md-12">{!! Lang::get('app.group') !!} <span class="help"> *</span></label>
                    <div class="col-md-12">
						{!! Form::select('user_group_id',App\Modules\UserGroup\UserGroup::lists(),isset($data) ? $data->user_group_id : null,['class' => 'form-control form-control-line','id'=>'user_group_id']) !!}
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-md-12">{!! Lang::get('app.email') !!} <span class="help"> *</span></label>
                    <div class="col-md-12">
						{!! Form::text('email',isset($data) ? $data->email : null,['class' => 'form-control form-control-line','id'=>'email','placeholder'=>lang::get('app.email'),'maxlength' => 100]) !!}
                    </div>
                </div>
				@if(!isset($data))
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
				@endif
				
			</div>
		</div>
	</div>
	{!! Form::close() !!}
@endsection

@push('scripts')
<script src="{!! Theme::asset('vendor/bootstrap-select2/js/select2.min.js') !!}"></script>
<script type="text/javascript">
$(document).ready(function(){
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