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

                $('#arbevetel').val(currencyFormatDE(parseInt(<?php echo $yearStacked->revenue; ?>)));
                $('#koltseg').val(currencyFormatDE(parseInt(<?php echo $yearStacked->spend; ?>)));
                $('#egyenleg').val(currencyFormatDE(parseInt(<?php echo $yearStacked->result; ?>)));
                $('#kp').val(currencyFormatDE(parseInt(<?php echo $yearStacked->cash; ?>)));
                $('#kartya').val(currencyFormatDE(parseInt(<?php echo $yearStacked->card; ?>)));
                $('#szkartya').val(currencyFormatDE(parseInt(<?php echo $yearStacked->szcard; ?>)));
                $('#atlag').val(currencyFormatDE(parseInt(<?php echo $yearStacked->average; ?>)));

            });

            $('.mountBtn').click(function () {

                $('#arbevetel').val(currencyFormatDE(parseInt(<?php echo $monthStacked->revenue; ?>)));
                $('#koltseg').val(currencyFormatDE(parseInt(<?php echo $monthStacked->spend; ?>)));
                $('#egyenleg').val(currencyFormatDE(parseInt(<?php echo $monthStacked->result; ?>)));
                $('#kp').val(currencyFormatDE(parseInt(<?php echo $monthStacked->cash; ?>)));
                $('#kartya').val(currencyFormatDE(parseInt(<?php echo $monthStacked->card; ?>)));
                $('#szkartya').val(currencyFormatDE(parseInt(<?php echo $monthStacked->szcard; ?>)));
                $('#atlag').val(currencyFormatDE(parseInt(<?php echo $monthStacked->average; ?>)));

            });

            $('.weekBtn').click(function () {

                $('#arbevetel').val(currencyFormatDE(parseInt(<?php echo $weekStacked->revenue; ?>)));
                $('#koltseg').val(currencyFormatDE(parseInt(<?php echo $weekStacked->spend; ?>)));
                $('#egyenleg').val(currencyFormatDE(parseInt(<?php echo $weekStacked->result; ?>)));
                $('#kp').val(currencyFormatDE(parseInt(<?php echo $weekStacked->cash; ?>)));
                $('#kartya').val(currencyFormatDE(parseInt(<?php echo $weekStacked->card; ?>)));
                $('#szkartya').val(currencyFormatDE(parseInt(<?php echo $weekStacked->szcard; ?>)));
                $('#atlag').val(currencyFormatDE(parseInt(<?php echo $weekStacked->average; ?>)));

            });

        });


    </script>
@endsection

