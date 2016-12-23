@extends('ict-backend-theme::main_layout',['title' => $page_title])
@section('content')
	{!! Form::open(['url' => '/bank/do-update','role' => 'form','id'=>'update_form','class' => 'form-material form-horizontal']) !!}
	{!! Form::hidden('id', isset($data) ?  Crypt::encrypt($data->id) : null, ['id' => 'id']) !!}
	<div class="row bg-title">
        <div class="col-lg-6">
          <h4 class="page-title"> {!! $page_title !!}</h4>
        </div>
        <div class="col-lg-6">
			<div class="pull-right">
				<div class="btn-group">
					@if(Role::access('u','bank'))
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
                    <label class="col-md-12">{!! Lang::get('app.name') !!} <span class="help"> *</span></label>
                    <div class="col-md-12">
						{!! Form::text('name',isset($data) ? $data->name : null,['class' => 'form-control form-control-line','id'=>'name','placeholder'=>lang::get('app.name'),'maxlength' => 100]) !!}
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-md-12">{!! Lang::get('app.country') !!} <span class="help"> *</span></label>
                    <div class="col-md-12">
						{!! Form::select('country_id',App\Modules\Country\Country::lists(),isset($data)?$data->country_id:null, ['class' => 'form-control form-control-line input-md','id'=>'country_id']) !!}
                    </div>
                </div>
				
			</div>
		</div>
		<div class="col-lg-6">
			<div class="white-box">
				<div class="form-group">
                    <label class="col-md-12">{!! Lang::get('app.description') !!} <span class="help"> *</span></label>
                    <div class="col-md-12">
						{!! Form::textarea('description',isset($data) ? $data->description : null,['rows'=>3,'class' => 'form-control form-control-line','id'=>'description','placeholder'=>lang::get('app.description'),'maxlength' => 255]) !!}
                    </div>
                </div>
			</div>
		</div>
	</div>
	{!! Form::close() !!}
@endsection

@push('scripts')

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