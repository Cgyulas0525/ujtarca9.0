<script type="text/javascript">

   function nameChange(field) {
       let name =  $('#name').val();
       if (name.length != 0) {
           $.ajax({
               method: 'POST',
               url: "{{url('api/getPartnerByName')}}",
               data: {
                   name: name,
               },
               success: function(response) {
                   console.log(response);
                   if (Object.keys(response).length === 0) {
                       let nextField = '#' + field;
                       $(nextField).focus();
                   } else {
                       $('#name').focus();
                       $('#name').val(null);
                       sw('Van már ezzen a néven partner!');
                   }
               },
               error: function(error) {
                   console.error('Hiba történt:', error);
               }
           });
       }
    }

</script>




