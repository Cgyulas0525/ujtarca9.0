<script type="text/javascript">

    function locationName() {
        let name =  $('#location_name').val();
        if (name.length != 0) {
            $.ajax({
                method: 'POST',
                url: "{{url('api/getLocationByName')}}",
                data: {
                    name: name,
                },
                success: function(response) {
                    if (Object.keys(response).length !== 0) {
                        $('#location_name').focus();
                        $('#location_name').val(null);
                        sw('Van már ezzen a néven cím!');
                    } else {
                        $('#addLocationBtn').text('Ment');
                    }
                },
                error: function(error) {
                    console.error('Hiba történt:', error);
                }
            });
        }
    }

</script>


