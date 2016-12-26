<div class="modal fade" id="payment" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            {!! Form::open(['url' => 'telephone-billing/do-update/payment','id'=>'update_payment_form','class'=>'form-horizontal form-material']) !!}
            {!! Form::hidden('id', isset($data) ?  Crypt::encrypt($data->id) : null, ['id' => 'id']) !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{!! Lang::get('app.make payment') !!}</h4>
            </div>
            <div class="modal-body">
                <div id="modalLoading"></div>

                <div class="form-group">
                    <label class="col-md-12">{!! Lang::get('app.date') !!} <span class="help"> *</span></label>
                    <div class="col-md-12">
                        {!! Form::text('date',isset($data) ? $data->print_date : null,['class' => 'form-control form-control-line','id'=>'date','placeholder'=>lang::get('app.print date'),'maxlength' => 12]) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-12">{!! Lang::get('app.payment method') !!} <span class="help"> *</span></label>
                    <div class="col-md-12">
                        {!! Form::select('payment_method_id',App\Modules\PaymentMethod\PaymentMethod::lists(),isset($data) ? $data->payment_method_id : null,['class' => 'form-control form-control-line','id'=>'payment_method_id','placeholder'=>lang::get('app.payment method')]) !!}
                    </div>
                </div>

                <div class="form-group" id="bank-account" style="display: none">
                    <label class="col-md-12">{!! Lang::get('app.bank account') !!} <span class="help"> *</span></label>
                    <div class="col-sm-12">
                        {!! Form::select('bank_account_id',\App\Modules\AccountBank\AccountBank::lists(),null, ['class' => 'form-control form-control-line','id'=>'bank_account_id']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-12">{!! Lang::get('app.total') !!} <span class="help"> *</span></label>
                    <div class="col-sm-12">
                        {!! Form::text('total',null, ['class' => 'text-right form-control form-control-line text-right','id'=>'total','placeholder'=> '0' ,'maxlength'=>18]) !!}
                    </div>

                </div>

                <div class="form-group">
                    <label class="col-md-12">{!! Lang::get('app.description') !!} <span class="help"> *</span></label>
                    <div class="col-sm-12">
                        {!! Form::textarea('description',null, ['rows'=>2,'class' => 'form-control form-control-line','id'=>'description','maxlength'=>255]) !!}
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button class="btn btn-primary btn-md" type="submit" id="btn-submit"><i class="fa fa-save"></i> {!! Lang::get('app.submit') !!}</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i> {!! Lang::get('app.close') !!}</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@push('stylesheet')
<link href="{!! Theme::asset('vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') !!}" rel="stylesheet"/>
@endpush
@push('script-extras')
<script src="{!! Theme::asset('vendor/eonasdan-datetimepicker/build/js/moment.min.js') !!}"></script>
<script src="{!! Theme::asset('vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') !!}"></script>
<script type="text/javascript">
    $(function() {
        jQuery('input[name="date"]').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
            todayHighlight: true
        });
        $('input[name="total"]').number(true,2);

        //load payment
        var payment_method_id = $('select[name="payment_method_id"]').val();
        load_payment_method(payment_method_id);

        $('select[name="payment_method_id"]').on('change', function(event) {
            event.preventDefault();
            $("#modalLoading").addClass('show');
            var payment_method_id = $(this).val();
            load_payment_method(payment_method_id);
            $("div#modalLoading").removeClass('show');
        });

        function load_payment_method(arg) {
            var payment_method_id = arg;
            $.getJSON("{!! url('/payment-method/get/type') !!}",{id:payment_method_id}, function(result) {
                if(result.type == 'Cash') {
                    $("#bank-account").slideUp();
                } else {
                    $("#bank-account").slideDown();
                }
            });
        }

        $('#update_payment_form').on('submit', function(event) {
            event.preventDefault();
            $("#modalLoading").addClass('show');
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
                        $.alert(response.message);
                        $(".help-block").remove();
                        window.location = response.redirect;
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