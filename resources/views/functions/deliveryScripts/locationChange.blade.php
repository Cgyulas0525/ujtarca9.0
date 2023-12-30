<script type="text/javascript">

   function locationChange() {
       let location_id = $('#location_id').val();
       if (location_id !== 0) {
           console.log(location_id);
           dateLocationChange();
       } else {
           $('#location_id').focus();
       }
    }

</script>




