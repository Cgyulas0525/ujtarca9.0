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
                   try {
                       var responseObject = JSON.parse(response);
                       if (responseObject === null) {
                           console.log('A JSON válasz objektum null.');
                       } else {
                           $('#name').focus();
                           $('#name').val(null);
                           sw('Van már ilyen nevű partner!');
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




