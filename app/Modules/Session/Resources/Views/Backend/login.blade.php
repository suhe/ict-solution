@extends('ict-backend-theme::main_login',['title' => $page_title])
@section('content')
<div class="login-box login-sidebar">
	<div class="white-box">
		{!! Form::open(['url' => 'session/do-login','id'=>'session_form','class'=>'form-horizontal form-material']) !!}
			<a href="{!! url('/') !!}" class="text-center db">
				<img src="{!! Theme::asset('img/small-logo.png') !!}" alt="{!! Lang::get('app.page title') !!}" />
			</a>  
					
			<div class="form-group m-t-40">
				<div class="col-xs-12">
					{!! Form::text('email', null, ['class' => 'form-control form-control-line','style'=>'padding:5px','id'=>'email','placeholder'=> Lang::get('app.email')]) !!}
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-xs-12">
					{!! Form::password('password', ['class' => 'form-control form-control-line','style'=>'padding:5px','id'=>'password','placeholder'=>Lang::get('app.password')]) !!}
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-md-12">
					<div class="checkbox checkbox-primary pull-left p-t-0">
						<input id="checkbox-signup" type="checkbox">
						<label for="checkbox-signup"> {!! Lang::get('app.remember me') !!} </label>
					</div>
				</div>
			</div>
			<div class="form-group text-center m-t-20">
				<div class="col-xs-12">
					<button class="btn btn-primary btn-rounded btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">{!! Lang::get('app.login') !!}</button>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
					<div class="social"><a href="javascript:void(0)" class="btn  btn-facebook" data-toggle="tooltip"  title="Login with Facebook"> <i aria-hidden="true" class="fa fa-facebook"></i> </a> <a href="javascript:void(0)" class="btn btn-googleplus" data-toggle="tooltip"  title="Login with Google"> <i aria-hidden="true" class="fa fa-google-plus"></i> </a> </div>
				</div>
			</div>
					
		{!! Form::close() !!}
				
		</div>
	</div>
</div>
@endsection

@push("scripts")
<script type="text/javascript">

    $(function() {
        $('#session_form').on('submit', function(event) {
            event.preventDefault();
            $("div#divLoading").addClass('show');
            $.ajax({
                type : $(this).attr('method'),
                url : $(this).attr('action'),
                data : $(this).serialize(),
                dataType : "json",
                cache : false,
                beforeSend : function() { console.log($(this).serialize());},
                success : function(response) {
					$(".help-block").remove();
                    if(response.success == false) {
                        $.each(response.message, function( index,message) {
                            var element = $('<p>' + message + '</p>').attr({'class' : 'help-block text-danger'}).css({display: 'none'});
                            $('#'+index).after(element);
                            $(element).fadeIn();
                        });
                    }
                    else {
                        $(".help-block").remove();
                        window.location = response.redirect;
                    }

                    $("div#divLoading").removeClass('show');
					
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