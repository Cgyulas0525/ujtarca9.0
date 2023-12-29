<script type="text/javascript">

   function emailChange(field) {
        let email =  $('#email').val();
        if (email.length != 0) {
            $.ajax({
                method: 'POST',
                url: "{{url('api/getPartnerByEmail')}}",
                data: {
                    email: email,
                },
                success: function(response) {
                    console.log(response);
                    if (Object.keys(response).length === 0) {
                        let nextField = '#' + field;
                        $(nextField).focus();
                    } else {
                        $('#email').focus();
                        $('#email').val(null);
                        sw('Van már ilyen email címmel partner!');
                    }
                },
                error: function(error) {
                    console.error('Hiba történt:', error);
                }
            });
        }
    }

</script>




