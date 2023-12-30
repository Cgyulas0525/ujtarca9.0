<script type="text/javascript">

   function dateLocationChange() {
       let date =  $('#date').val();
       let location_id = $('#location_id').val();

       console.log(date, location_id);
       {{--if (email.length != 0) {--}}
       {{--    $.ajax({--}}
       {{--        method: 'POST',--}}
       {{--        url: "{{url('api/getPartnerByEmail')}}",--}}
       {{--        data: {--}}
       {{--            email: email,--}}
       {{--        },--}}
       {{--        success: function(response) {--}}
       {{--            console.log(response);--}}
       {{--            if (Object.keys(response).length === 0) {--}}
       {{--                let nextField = '#' + field;--}}
       {{--                $(nextField).focus();--}}
       {{--            } else {--}}
       {{--                $('#email').focus();--}}
       {{--                $('#email').val(null);--}}
       {{--                sw('Van már ilyen email címmel partner!');--}}
       {{--            }--}}
       {{--        },--}}
       {{--        error: function(error) {--}}
       {{--            console.error('Hiba történt:', error);--}}
       {{--        }--}}
       {{--    });--}}
       {{--}--}}
    }

</script>




