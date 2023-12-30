<script type="text/javascript">

   function dateChange() {
       let date =  $('#date').val();
       var today = new Date();
       var formattedDate = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
       if (date.length > 0) {
           if (formattedDate > date) {
               sw('A mai napnál nem lehet korábbi dátum!');
               $('#date').val(formattedDate);
               $('#date').focus();
           } else {
               dateLocationChange();
           }
       } else {
           $('#date').val(formattedDate);
           $('#date').focus();
       }
    }

</script>




