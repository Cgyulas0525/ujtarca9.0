<?php
    $yearStacked = App\Models\YearStacked::where('year', date('Y'))->first();
    $monthStacked = App\Models\Monthstacked::where('year', date('Y'))->where('month', date('m'))->first();
    $weekStacked = App\Models\Weekstacked::where('year', date('Y'))->where('week', date('W'))->first();
?>

<li class="nav-item">
    <a href="{!! route($route) !!}" class="nav-link-black">
        <div class="row">
            <div class="col-lg-3">
                {{ $title }}
            </div>
            <div class="col-lg-9">
                {{ Form::text('out', $value, ['class' => 'form-control  text-right', 'id' => isset($id) ? $id : "id", 'readonly' => 'true'])  }}
            </div>
        </div>
    </a>
</li>

@section('scripts')
    <script src="{{ asset('/public/js/currencyFormatDE.js') }} " type="text/javascript"></script>

    <script type="text/javascript">
        $(function () {

            $('.yearBtn').click(function () {

                $('#arbevetel').val(currencyFormatDE(parseInt(<?php echo !is_null($yearStacked) ? $yearStacked->revenue : 0; ?>)));
                $('#koltseg').val(currencyFormatDE(parseInt(<?php echo !is_null($yearStacked) ? $yearStacked->spend : 0; ?>)));
                $('#egyenleg').val(currencyFormatDE(parseInt(<?php echo !is_null($yearStacked) ? $yearStacked->result : 0; ?>)));
                $('#kp').val(currencyFormatDE(parseInt(<?php echo !is_null($yearStacked) ? $yearStacked->cash : 0; ?>)));
                $('#kartya').val(currencyFormatDE(parseInt(<?php echo !is_null($yearStacked) ? $yearStacked->card : 0; ?>)));
                $('#szkartya').val(currencyFormatDE(parseInt(<?php echo !is_null($yearStacked) ? $yearStacked->szcard : 0; ?>)));
                $('#atlag').val(currencyFormatDE(parseInt(<?php echo !is_null($yearStacked) ? $yearStacked->average : 0; ?>)));

            });

            $('.mountBtn').click(function () {

                $('#arbevetel').val(currencyFormatDE(parseInt(<?php echo !is_null($monthStacked) ? $monthStacked->revenue : 0; ?>)));
                $('#koltseg').val(currencyFormatDE(parseInt(<?php echo !is_null($monthStacked) ? $monthStacked->spend : 0; ?>)));
                $('#egyenleg').val(currencyFormatDE(parseInt(<?php echo !is_null($monthStacked) ? $monthStacked->result : 0; ?>)));
                $('#kp').val(currencyFormatDE(parseInt(<?php echo !is_null($monthStacked) ? $monthStacked->cash : 0; ?>)));
                $('#kartya').val(currencyFormatDE(parseInt(<?php echo !is_null($monthStacked) ? $monthStacked->card : 0; ?>)));
                $('#szkartya').val(currencyFormatDE(parseInt(<?php echo !is_null($monthStacked) ? $monthStacked->szcard : 0; ?>)));
                $('#atlag').val(currencyFormatDE(parseInt(<?php echo !is_null($monthStacked) ? $monthStacked->average : 0; ?>)));

            });

            $('.weekBtn').click(function () {

                $('#arbevetel').val(currencyFormatDE(parseInt(<?php echo !is_null($weekStacked) ? $weekStacked->revenue : 0; ?>)));
                $('#koltseg').val(currencyFormatDE(parseInt(<?php echo !is_null($weekStacked) ?$weekStacked->spend : 0; ?>)));
                $('#egyenleg').val(currencyFormatDE(parseInt(<?php echo !is_null($weekStacked) ?$weekStacked->result : 0; ?>)));
                $('#kp').val(currencyFormatDE(parseInt(<?php echo !is_null($weekStacked) ?$weekStacked->cash : 0; ?>)));
                $('#kartya').val(currencyFormatDE(parseInt(<?php echo !is_null($weekStacked) ?$weekStacked->card : 0; ?>)));
                $('#szkartya').val(currencyFormatDE(parseInt(<?php echo !is_null($weekStacked) ?$weekStacked->szcard : 0; ?>)));
                $('#atlag').val(currencyFormatDE(parseInt(<?php echo !is_null($weekStacked) ?$weekStacked->average : 0; ?>)));

            });

        });


    </script>
@endsection

