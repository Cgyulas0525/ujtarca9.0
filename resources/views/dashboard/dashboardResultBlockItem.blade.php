<?php
    $params['stacked']['firstMonth'] = App\Models\Monthstacked::where('year', date('Y'))->where('month', date('m'))->first();
    $params['stacked']['firstWeek'] = App\Models\Weekstacked::where('year', date('Y'))->where('week', date('W'))->first();
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
    @include('functions.currencyFormatDE')

    <script type="text/javascript">
        $(function () {

            $('.yearBtn').click(function () {

                $('#arbevetel').val(currencyFormatDE(parseInt(<?php echo !is_null($params['stacked']['first']) ? $params['stacked']['first']->revenue : 0; ?>)));
                $('#koltseg').val(currencyFormatDE(parseInt(<?php echo !is_null($params['stacked']['first']) ? $params['stacked']['first']->spend : 0; ?>)));
                $('#egyenleg').val(currencyFormatDE(parseInt(<?php echo !is_null($params['stacked']['first']) ? $params['stacked']['first']->result : 0; ?>)));
                $('#kp').val(currencyFormatDE(parseInt(<?php echo !is_null($params['stacked']['first']) ? $params['stacked']['first']->cash : 0; ?>)));
                $('#kartya').val(currencyFormatDE(parseInt(<?php echo !is_null($params['stacked']['first']) ? $params['stacked']['first']->card : 0; ?>)));
                $('#szkartya').val(currencyFormatDE(parseInt(<?php echo !is_null($params['stacked']['first']) ? $params['stacked']['first']->szcard : 0; ?>)));
                $('#atlag').val(currencyFormatDE(parseInt(<?php echo !is_null($params['stacked']['first']) ? $params['stacked']['first']->average : 0; ?>)));

            });

            $('.mountBtn').click(function () {

                $('#arbevetel').val(currencyFormatDE(parseInt(<?php echo !is_null($params['stacked']['firstMonth']) ? $params['stacked']['firstMonth']->revenue : 0; ?>)));
                $('#koltseg').val(currencyFormatDE(parseInt(<?php echo !is_null($params['stacked']['firstMonth']) ? $params['stacked']['firstMonth']->spend : 0; ?>)));
                $('#egyenleg').val(currencyFormatDE(parseInt(<?php echo !is_null($params['stacked']['firstMonth']) ? $params['stacked']['firstMonth']->result : 0; ?>)));
                $('#kp').val(currencyFormatDE(parseInt(<?php echo !is_null($params['stacked']['firstMonth']) ? $params['stacked']['firstMonth']->cash : 0; ?>)));
                $('#kartya').val(currencyFormatDE(parseInt(<?php echo !is_null($params['stacked']['firstMonth']) ? $params['stacked']['firstMonth']->card : 0; ?>)));
                $('#szkartya').val(currencyFormatDE(parseInt(<?php echo !is_null($params['stacked']['firstMonth']) ? $params['stacked']['firstMonth']->szcard : 0; ?>)));
                $('#atlag').val(currencyFormatDE(parseInt(<?php echo !is_null($params['stacked']['firstMonth']) ? $params['stacked']['firstMonth']->average : 0; ?>)));

            });

            $('.weekBtn').click(function () {

                $('#arbevetel').val(currencyFormatDE(parseInt(<?php echo !is_null($params['stacked']['firstWeek']) ? $params['stacked']['firstWeek']->revenue : 0; ?>)));
                $('#koltseg').val(currencyFormatDE(parseInt(<?php echo !is_null($params['stacked']['firstWeek']) ?$params['stacked']['firstWeek']->spend : 0; ?>)));
                $('#egyenleg').val(currencyFormatDE(parseInt(<?php echo !is_null($params['stacked']['firstWeek']) ?$params['stacked']['firstWeek']->result : 0; ?>)));
                $('#kp').val(currencyFormatDE(parseInt(<?php echo !is_null($params['stacked']['firstWeek']) ?$params['stacked']['firstWeek']->cash : 0; ?>)));
                $('#kartya').val(currencyFormatDE(parseInt(<?php echo !is_null($params['stacked']['firstWeek']) ?$params['stacked']['firstWeek']->card : 0; ?>)));
                $('#szkartya').val(currencyFormatDE(parseInt(<?php echo !is_null($params['stacked']['firstWeek']) ?$params['stacked']['firstWeek']->szcard : 0; ?>)));
                $('#atlag').val(currencyFormatDE(parseInt(<?php echo !is_null($params['stacked']['firstWeek']) ?$params['stacked']['firstWeek']->average : 0; ?>)));

            });

        });


    </script>
@endsection

