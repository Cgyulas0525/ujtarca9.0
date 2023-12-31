<script type="text/javascript">

   function emailChange() {
        let email =  $('#email').val();
        let ret = true;
        if (email.length != 0) {
            $.ajax({
                method: 'POST',
                url: "{{url('api/getPartnerByEmail')}}",
                data: {
                    email: email,
                },
                success: function(response) {
                    if (Object.keys(response).length !== 0) {
                        $('#email').focus();
                        $('#email').val(null);
                        sw('Van már ilyen email címmel partner!');
                        ret = false;
                    }
                },
                error: function(error) {
                    console.error('Hiba történt:', error);
                }
            });
        }
        return ret;
    }

</script>




