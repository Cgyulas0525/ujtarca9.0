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
                    try {
                        var responseObject = JSON.parse(response);
                        if (responseObject === null) {
                            console.log('A JSON válasz objektum null.');
                        } else {
                            $('#email').focus();
                            $('#email').val(null);
                            sw('Van már ilyen email címmel partner!');
                        }
                    } catch (error) {
                        let nextField = '#' + field;
                        $(nextField).focus();
                    }
                },
                error: function(error) {
                    console.error('Hiba történt:', error);
                }
            });
        }
    }

</script>




