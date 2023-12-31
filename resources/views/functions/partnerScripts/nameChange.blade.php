<script type="text/javascript">

   function nameChange() {
       let name =  $('#name').val();
       let ret = true;
       if (name.length != 0) {
           $.ajax({
               method: 'POST',
               url: "{{url('api/getPartnerByName')}}",
               data: {
                   name: name,
               },
               success: function(response) {
                   if (Object.keys(response).length !== 0) {
                       $('#name').focus();
                       $('#name').val(null);
                       sw('Van már ezzen a néven partner!');
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




