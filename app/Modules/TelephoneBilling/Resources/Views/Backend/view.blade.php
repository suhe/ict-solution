@extends('ict-backend-theme::main_layout',['title' => $page_title])
@section('content')
	{!! Form::open(['url' => '#','role' => 'form','id'=>'update_form','class' => 'form-material form-horizontal']) !!}
	<div class="row bg-title">
        <div class="col-lg-5">
          <h4 class="page-title"> {!! $page_title !!}</h4>
        </div>

        <div class="col-lg-7">
			<div class="pull-right">

				<div class="btn-group">
					@if(Role::access('c','telephone-billing'))
                            <a href="{!! url('/telephone-billing/form') !!}" class="btn btn-rounded btn-primary btn-md"><i class="fa fa-plus"></i> {!! Lang::get("app.create") !!}</a>
					@endif
					@if(Role::access('u','telephone-billing'))
                            <a href="{!! url('/telephone-billing/export/pdf/statement/'.Crypt::encrypt($data->id)) !!}" class="btn btn-rounded btn-primary btn-md"><i class="fa fa-file-pdf-o"></i> {!! Lang::get("app.billing statement") !!}</a>
							<a href="{!! url('/telephone-billing/export/pdf/invoice/'.Crypt::encrypt($data->id)) !!}" class="btn btn-rounded btn-primary btn-md"><i class="fa fa-file-pdf-o"></i> {!! Lang::get("app.invoice") !!}</a>
							<a href="{!! url('/telephone-billing/form/'.Crypt::encrypt($data->id)) !!}" class="btn btn-primary btn-rounded btn-md"><i class="fa fa-pencil"></i> {!! Lang::get("app.edit") !!}</a>
                            <a href="#" class="btn btn-primary btn-md" data-toggle="modal" data-target="#payment"><i class="fa fa-money"></i> {!! Lang::get("app.make payment") !!}</a>
					@endif

					<a href="{!! url('/telephone-billing') !!}" class="btn btn-primary btn-rounded btn-md"><i class="fa fa-undo"></i> {!! Lang::get("app.back") !!}</a>
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
						{!! Form::text('customer_name',isset($data) ? $data->customer_name : null,['readonly'=>true,'class' => 'form-control form-control-line','id'=>'customer_name','placeholder'=>lang::get('app.customer_name'),'maxlength' => 100]) !!}
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
						{!! Form::text('customer_city',isset($data) ? $data->customer_city : null,['readonly'=>true,'class' => 'form-control form-control-line','id'=>'customer_city','placeholder'=>lang::get('app.customer_city'),'maxlength' => 100]) !!}
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
						{!! Form::text('contact_person',isset($data) ? $data->contact_person : null,['class' => 'form-control form-control-line','id'=>'contact_person','placeholder'=>lang::get('app.contact person'),'maxlength' => 100]) !!}
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-md-12">{!! Lang::get('app.position') !!} <span class="help"> *</span></label>
                    <div class="col-md-12">
						{!! Form::text('contact_position',isset($data) ? $data->contact_position : null,['class' => 'form-control form-control-line','id'=>'contact_position','placeholder'=>lang::get('app.contact position'),'maxlength' => 100]) !!}
                    </div>
                </div>
				
			</div>
		</div>
		<div class="col-lg-6">
			<div class="white-box">
				<div class="form-group">
                    <label class="col-md-12">{!! Lang::get('app.invoice number') !!} <span class="help"> *</span></label>
                    <div class="col-md-12">
						{!! Form::text('invoice_number',isset($data) ? $data->number : null,['readonly'=>true,'class' => 'form-control form-control-line','id'=>'invoice_number','placeholder'=>lang::get('app.invoice number'),'maxlength' => 100]) !!}
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-md-12">{!! Lang::get('app.customer id') !!} <span class="help"> *</span></label>
                    <div class="col-md-12">
						{!! Form::text('customer_id',isset($data) ? $data->customer_id : null,['class' => 'form-control form-control-line','id'=>'customer_id','placeholder'=>lang::get('app.customer id'),'maxlength' => 100]) !!}
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-md-12">{!! Lang::get('app.payment method') !!} <span class="help"> *</span></label>
                    <div class="col-md-12">
						{!! Form::text('payment_method',isset($data) ? $data->payment_method : null,['class' => 'form-control form-control-line','id'=>'payment_method_id','placeholder'=>lang::get('app.payment method'),'maxlength' => 100]) !!}
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-md-12">{!! Lang::get('app.payment frequency') !!} <span class="help"> *</span></label>
                    <div class="col-md-12">
						{!! Form::text('payment_frequency',isset($data) ? $data->payment_frequency : null,['class' => 'form-control form-control-line','id'=>'payment_frequency','placeholder'=>lang::get('app.payment frequency'),'maxlength' => 100]) !!}
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
						{!! Form::text('service_periode',isset($data) ? $data->service_period : null,['class' => 'form-control form-control-line','id'=>'service_periode','placeholder'=>lang::get('app.service periode'),'maxlength' => 12]) !!}
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
					<li class="active tab"><a href="#home" data-toggle="tab"> <span class="visible-xs"><i class="fa fa-home"></i></span> <span class="hidden-xs">{!! Lang::get('app.summary') !!}</span> </a> </li>
					<li class="tab"><a href="#details" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="fa fa-cog"></i></span> <span class="hidden-xs">{!! Lang::get('app.detail') !!}</span> </a> </li>
					<li class="tab"><a href="#payment-history" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="fa fa-money"></i></span> <span class="hidden-xs">{!! Lang::get('app.payment') !!}</span> </a> </li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="home">
						<table class="table table-striped">
							<thead>
								<tr>
									<th class="col-md-9">{!! Lang::get('app.description') !!}</th>
									<th class="col-md-3 text-center">{!! Lang::get('app.total') !!}</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>{!! Lang::get('app.abodemen') !!}</td>
									<td class="text-right">{!! number_format($data->abodemen,2) !!}</td>
								</tr>
								<tr>
									<td>{!! Lang::get('app.japati') !!}</td>
									<td class="text-right">{!! number_format($data->japati,2) !!}</td>
								</tr>
								<tr>
									<td>{!! Lang::get('app.mobile') !!}</td>
									<td class="text-right">{!! number_format($data->mobile,2) !!}</td>
								</tr>
								<tr>
									<td>{!! Lang::get('app.local') !!}</td>
									<td class="text-right">{!! number_format($data->local,2) !!}</td>
								</tr>
								<tr>
									<td>{!! Lang::get('app.sljj') !!}</td>
									<td class="text-right">{!! number_format($data->sljj,2) !!}</td>
								</tr>
								<tr>
									<td>{!! Lang::get('app.sli 007') !!}</td>
									<td class="text-right">{!! number_format($data->sli_007,2) !!}</td>
								</tr>
								<tr>
									<td>{!! Lang::get('app.telkom global 017') !!}</td>
									<td class="text-right">{!! number_format($data->telkom_global_017,2) !!}</td>
								</tr>
								<tr>
									<td>{!! Lang::get('app.surcharge') !!}</td>
									<td class="text-right">{!! number_format($data->surcharge,2) !!}</td>
								</tr>
								<tr>
									<td>{!! Lang::get('app.ppn') !!}</td>
									<td class="text-right">{!! number_format($data->ppn,2) !!}</td>
								</tr>
							</tbody>
							<tfoot>
								<tr>
									<th class="col-md-9">{!! Lang::get('app.total bill') !!}</th>
									<th class="col-md-3 text-right"><strong>{!! number_format($data->total_bill,2) !!}</strong></th>
								</tr>
							</tfoot>
						</table>
					</div>
					<div class="tab-pane" id="details">
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
									
									@foreach($details as $key => $row)
									<tr>
										<td>{!! $row->phone_number !!}</td>
										<td>{!! $row->period !!}</td>
										<td class="text-right">{!! number_format($row->abodemen,2) !!}</td>
										<td class="text-right">{!! number_format($row->japati,2) !!}</td>
										<td class="text-right">{!! number_format($row->mobile,2) !!}</td>
										<td class="text-right">{!! number_format($row->local,2) !!}</td>
										<td class="text-right">{!! number_format($row->sljj,2) !!}</td>
										<td class="text-right">{!! number_format($row->sli_007,2) !!}</td>
										<td class="text-right">{!! number_format($row->telkom_global_017,2) !!}</td>
										<td class="text-right">{!! number_format($row->surcharge_total,2) !!}</td>
										<td class="text-right">{!! number_format($row->ppn_total,2) !!}</td>
										<td class="text-right">{!! number_format($row->subtotal,2) !!}</td>
									</tr>
									@endforeach
								</tbody>
								<tfoot>
									<tr>
										<th colspan="2" class="text-right">{!! Lang::get('app.total bill') !!}</th>
										<th class="text-right"><strong>{!! number_format($data->abodemen,2) !!}</strong></th>
										<th class="text-right"><strong>{!! number_format($data->japati,2) !!}</strong></th>
										<th class="text-right"><strong>{!! number_format($data->mobile,2) !!}</strong></th>
										<th class="text-right"><strong>{!! number_format($data->local,2) !!}</strong></th>
										<th class="text-right"><strong>{!! number_format($data->sljj,2) !!}</strong></th>
										<th class="text-right"><strong>{!! number_format($data->sli_007,2) !!}</strong></th>
										<th class="text-right"><strong>{!! number_format($data->telkom_global_017,2) !!}</strong></th>
										<th class="text-right"><strong>{!! number_format($data->surcharge_total,2) !!}</strong></th>
										<th class="text-right"><strong>{!! number_format($data->ppn_total,2) !!}</strong></th>
										<th class="text-right"><strong>{!! number_format($data->total_bill,2) !!}</strong></th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>

					<div class="tab-pane" id="payment-history">
						<div class="table-responsive" id="table-payment-history">
							<table class="table table-striped">
								<thead>
								<tr>
									<th class="col-md-1">{!! Lang::get('app.date') !!}</th>
									<th class="col-md-1">{!! Lang::get('app.payment method') !!}</th>
									<th class="col-md-3">{!! Lang::get('app.bank account') !!}</th>
									<th class="col-md-3">{!! Lang::get('app.description') !!}</th>
									<th class="col-md-2 text-center">{!! Lang::get('app.balanced') !!}</th>
									<th class="col-md-2 text-center">{!! Lang::get('app.saldo') !!}</th>
									<th class="col-md-1 text-center">***</th>
								</tr>
								</thead>
								<tbody>
								@php
									$balanced = $data->total_bill;
									$saldo = $balanced;
								@endphp
								<tr>
									<td>{!! $row->date !!}</td>
									<td>{!! $row->payment_method !!}</td>
									<td>{!! $row->bank_account !!}</td>
									<td>{!! Lang::get('app.balanced') !!}</td>
									<td class="text-right">{!! number_format($balanced,2) !!}</td>
									<td class="text-right">{!! number_format($saldo,2) !!}</td>
									<td class="text-center">

									</td>
								</tr>
								@foreach($telephone_billing_payments as $key => $row)
									@php
										$balanced = $row->total;
										$saldo = $saldo - $balanced;
									@endphp
									<tr class="row-{!! $row->id !!}">
										<td>{!! $row->date !!}</td>
										<td>{!! $row->payment_method !!}</td>
										<td>{!! $row->bank_account !!}</td>
										<td>{!! $row->description !!}</td>
										<td class="text-right">{!! number_format($balanced ,2) !!}</td>
										<td class="text-right">{!! number_format($saldo,2) !!}</td>
										<td class="text-center">
											<div class="btn-group dropup m-r-10">
												<button class="btn btn-sm btn-primary btn-rounded dropdown-toggle waves-effect waves-light" type="button" data-toggle="dropdown">
													<i class="fa fa-pencil"> {!! Lang::get('app.edit') !!}</i>
													<span class="caret"></span>
												</button>
												<ul class="dropdown-menu">
													<li><a href="{!! url('/telephone-billing/export/pdf/payment-receipt/'.Crypt::encrypt($row->id)) !!}"> {!! Lang::get('app.print') !!}</a></li>
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
						</div>
					</div>

				</div>	
			</div>
		</div>
	</div>	
	{!! Form::close() !!}
    @include('telephone-billing::Backend.payment')
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
						url   : "{!! url('/telephone-billing/do-delete/payment') !!}",
						data  : {id:id},
						dataType: "json",
						cache : false,
						beforeSend: function(xhr) {xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf_token"]').attr('content'))},
						success : function(response) {
							$("div#divLoading").removeClass('show');
							if(response.success == true) {
								$(".row-" + response.id).remove();
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
	});
</script>
@endpush