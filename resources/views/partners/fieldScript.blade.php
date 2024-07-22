@include('functions.ajax_js')
@include('functions.required_js')
@include('functions.sweetalert_js')
@include('functions.settlement.settlementPostcode_js')


<script type="text/javascript">
    $(function () {

        ajaxSetup();

        $('#taxnumber').inputmask();
        $('#bankaccount').inputmask();
        $('#phonenumber').inputmask();

        RequiredBackgroundModify('.form-control')

        {{--$('#btnLive').click(function (e) {--}}
        {{--    swal.fire({--}}
        {{--        title: "Partner kikapcsolás!",--}}
        {{--        text: "Biztosan kikapcsolja a tételt?",--}}
        {{--        icon: "warning",--}}
        {{--        showCancelButton: true,--}}
        {{--        confirmButtonColor: "#DD6B55",--}}
        {{--        confirmButtonText: "Kikapcsolás",--}}
        {{--        cancelButtonText: "Kilép",--}}
        {{--    }).then((result) => {--}}
        {{--        if (result.isConfirmed) {--}}
        {{--            var rows = table.rows({selected: true}).data();--}}
        {{--            for (i = 0; i < rows.length; i++) {--}}
        {{--                $.ajax({--}}
        {{--                    type: "GET",--}}
        {{--                    url: "{{url('api/copyCustomerOrderDetailToShoppingCart')}}",--}}
        {{--                    data: {Id: rows[i].Id, Product: rows[i].Product},--}}
        {{--                    success: function (response) {--}}
        {{--                        console.log('Error:', response);--}}
        {{--                    },--}}
        {{--                    error: function (response) {--}}
        {{--                        console.log('Error:', response);--}}
        {{--                        alert('nem ok');--}}
        {{--                    }--}}
        {{--                });--}}
        {{--            }--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}
    });
</script>
