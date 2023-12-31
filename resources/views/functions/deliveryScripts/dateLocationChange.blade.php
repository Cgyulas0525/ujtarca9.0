<script type="text/javascript">

   function dateLocationChange() {
       let date =  $('#date').val();
       let location_id = $('#location_id').val();

       if (date.length > 0 && location_id !== 0) {
           $.ajax({
               method: 'POST',
               url: "{{url('api/getDeliveryByDateAndLocation')}}",
               data: {
                   date: date,
                   location_id: location_id,
               },
               success: function(response) {
                   if (Object.keys(response).length === 0) {
                       $('#addDeliveryBtn').text('Ment');
                   } else {
                       $('#location_id').focus();
                       $('#loaction_id').val(null);
                       sw('Van már ezzel a címmel és dátummal kiszállítás!');
                   }
               },
               error: function(error) {
                   console.error('Hiba történt:', error);
               }
           });
       }
    }

</script>




