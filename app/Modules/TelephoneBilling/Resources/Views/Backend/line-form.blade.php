<div class="modal fade" id="line-form" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			{!! Form::open(['url' => 'telephone-billing/do-update/line','id'=>'update_line_form','class'=>'form-material form-horizontal']) !!}
			{!! Form::hidden('id', null, ['id' => 'id']) !!}
			{!! Form::hidden('telephone_billing_id', isset($data) ?  Crypt::encrypt($data->id) : null, ['id' => 'telephone_billing_id']) !!}
			
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title"><i class="fa fa-mobile"></i> {!! Lang::get('app.line form') !!}</h4>
			</div>
			
			<div class="modal-body">
				<div id="modalLoading"></div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-12">{!! Lang::get('app.phone number') !!} <span class="help"> *</span></label>
							<div class="col-md-12">
								{!! Form::text('phone_number',isset($data) ? $data->phone_number : null,['class' => 'form-control form-control-line','id'=>'phone_number','placeholder'=>lang::get('app.phone number'),'maxlength' => 28]) !!}
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-12">{!! Lang::get('app.period') !!} <span class="help"> *</span></label>
							<div class="col-md-12">
								{!! Form::text('period',isset($data) ? $data->period : null,['class' => 'form-control form-control-line','id'=>'period','placeholder'=>lang::get('app.period'),'maxlength' => 100]) !!}
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-12">{!! Lang::get('app.abodemen') !!} <span class="help"> *</span></label>
							<div class="col-md-12">
								{!! Form::text('abodemen',isset($data) ? $data->abodemen : 0,['class' => 'form-control form-control-line text-right','id'=>'abonemen','placeholder'=>'0','maxlength' => 100]) !!}
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-12">{!! Lang::get('app.japati') !!} <span class="help"> *</span></label>
							<div class="col-md-12">
								{!! Form::text('japati',isset($data) ? $data->japati : 0,['class' => 'form-control form-control-line text-right','id'=>'japati','placeholder'=>'0','maxlength' => 100]) !!}
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-12">{!! Lang::get('app.surcharge') !!} <span class="help"> *</span></label>
							<div class="col-md-2">
								{!! Form::text('surcharge',isset($data) ? $data->surcharge : 15,['class' => 'form-control form-control-line text-right','id'=>'surcharge','placeholder'=>'%','maxlength' => 2]) !!}
							</div>
						</div>
					</div>
					
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-12">{!! Lang::get('app.mobile') !!} <span class="help"> *</span></label>
							<div class="col-md-12">
								{!! Form::text('mobile',isset($data) ? $data->mobile : 0,['class' => 'form-control form-control-line text-right','id'=>'mobile','placeholder'=>'0','maxlength' => 100]) !!}
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-12">{!! Lang::get('app.local') !!} <span class="help"> *</span></label>
							<div class="col-md-12">
								{!! Form::text('local',isset($data) ? $data->local: 0,['class' => 'form-control form-control-line text-right','id'=>'local','placeholder'=>'0','maxlength' => 100]) !!}
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-12">{!! Lang::get('app.sljj') !!} <span class="help"> *</span></label>
							<div class="col-md-12">
								{!! Form::text('sljj',isset($data) ? $data->sljj: 0,['class' => 'form-control form-control-line text-right','id'=>'sljj','placeholder'=>'0','maxlength' => 100]) !!}
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-12">{!! Lang::get('app.sli 007') !!} <span class="help"> *</span></label>
							<div class="col-md-12">
								{!! Form::text('sli_007',isset($data) ? $data->sli_007: 0,['class' => 'form-control form-control-line text-right','id'=>'sli_007','placeholder'=>'0','maxlength' => 100]) !!}
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-12">{!! Lang::get('app.telkom global 017') !!} <span class="help"> *</span></label>
							<div class="col-md-12">
								{!! Form::text('telkom_global_017',isset($data) ? $data->telkom_global_017: 0,['class' => 'form-control form-control-line text-right','id'=>'telkom_global_017','placeholder'=>'0','maxlength' => 100]) !!}
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-12">{!! Lang::get('app.ppn') !!} <span class="help"> *</span></label>
							<div class="col-md-2">
								{!! Form::text('ppn',isset($data) ? $data->ppn : 10,['class' => 'form-control form-control-line text-right','id'=>'ppn','placeholder'=>'%','maxlength' => 2]) !!}
							</div>
						</div>
					</div>
					
				</div>
			</div>	
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary btn-md" id="xbtn-submit"><i class="fa fa-save"></i> {!! Lang::get('app.submit') !!}</button>
				<button type="button" class="btn btn-primary" data-dismiss="modal">{!! Lang::get('app.close') !!}</button>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@push('script-extras')
<script type="text/javascript">
$(function() {
	$('input[name="abodemen"]').number(true,2);
	$('input[name="japati"]').number(true,2);
	$('input[name="surcharge"]').number(true,0);
	$('input[name="mobile"]').number(true,2);
	$('input[name="local"]').number(true,2);
	$('input[name="sli_007"]').number(true,2);
	$('input[name="telkom_global_017"]').number(true,2);
	$('input[name="ppn"]').number(true,0);
	
	$('#update_line_form').on('submit', function(event) {
		event.preventDefault();
		$("div#modalLoading").addClass('show');	
		$.ajax({
			type : $(this).attr('method'),
			url : $(this).attr('action'),
			data : $(this).serialize(),
			dataType : "json",
			cache : false,
			beforeSend : function() { console.log($(this).serialize());},
			success : function(response) {
				$(".help-block").remove();
				$("div#modalLoading").removeClass('show');
				
				if(response.success == false) {
					$.each(response.message, function( index,message) {
						var element = $('<p>' + message + '</p>').attr({'class' : 'help-block text-danger'}).css({display: 'none'});
						$('#'+index).after(element);
						$(element).fadeIn();
					});
				} else {
					var row = "";
					row+="<tr>";
					row+="<td class='text-center'> <span> <a class='line_edit' id ="+response.rowId+"' href='#'><i class='fa fa-pencil'></i> </a> &nbsp;  <a class='line_delete' id='"+response.rowId+"' href='#'><i class='fa fa-trash'></i> </a></span></td>";
					row+="<td> " + response.phone_number + " </td>";
					row+="<td> " + response.period + " </td>";
					row+="<td class='text-right'>" + response.abodemen + " </td>";
					row+="<td class='text-right'>" + response.japati + " </td>";
					row+="<td class='text-right'>" + response.mobile + " </td>";
					row+="<td class='text-right'>" + response.local + " </td>";
					row+="<td class='text-right'>" + response.sljj + " </td>";
					row+="<td class='text-right'>" + response.sli_007 + " </td>";
					row+="<td class='text-right'>" + response.telkom_global_017 + " </td>";
					row+="<td class='text-right'>" + response.surcharge + " </td>";
					row+="<td class='text-right'>" + response.ppn + " </td>";
					row+="<td class='text-right'>" + response.subtotal + " </td>";
					row+="</tr>";
					$('table#table_items tbody').prepend(row);
					$('#line-form').modal('hide');
				}
			},
			error : function() {
				$(".help-block").remove();
				$("div#modalLoading").removeClass('show');
			}
		});
		return false;
	});
});
</script>
@endpush