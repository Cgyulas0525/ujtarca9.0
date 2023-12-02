@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                        Kiszállítás
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'deliveries.store', 'id' => 'basicForm']) !!}

            <div class="card-body">

                <div class="row">
                    @include('deliveries.fields')
                </div>

            </div>

            <div class="card-footer">
                <a href="#" class="btn btn-primary" id="otherBtn">Ment</a>
                <a href="{{ route('deliveries.index') }}" class="btn btn-default"> Kilép </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('/js/required.js') }} " type="text/javascript"></script>
    @include('functions.settlement.settlementPostcode_js')
    @include('deliveries.addModalBtn_js')

    <script type="text/javascript">

        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        });

        $('#otherBtn').click(function (e) {
            $.ajax({
                type:"GET",
                url:"{{url('storeModal')}}",
                data: {
                    delivery_number: $('#delivery_number').val(),
                    date: $('#date').val(),
                    location_id: $('#location_id').val(),
                    description: $('#description').val(),
                },
                success: function (response) {
                    console.log('Ok:', response);
                    var url = "{{ route('deliveries.index') }}";
                    window.location.href = url;
                },
                error: function (response) {
                    console.log('Error:', response);
                    alert('nem ok');
                }
            });
        });

        RequiredBackgroundModify('.form-control')

        $('#addModalBtn').click(function() {
            addMoldalBtn();
        });
    </script>
@endsection
