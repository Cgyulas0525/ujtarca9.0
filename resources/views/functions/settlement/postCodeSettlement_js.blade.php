<script type="text/javascript">

    function postCodeSettlement() {
        let postalCode = $('#postcode').val();
        $.ajax({
            type:"GET",
            url:"{{url('postalcodeSettlementsDDDW')}}",
            data: { postalcode: postalCode },
            success:function(res){
                if(res){
                    $("#settlement").empty();
                    console.log(res[0].settlement);
                    if (res.length == 1) {
                        $("#settlement").append('<option value="'+(res[0].settlement)+'">'+(res[0].settlement)+'</option>');
                    } else {
                        $.each(res,function(key,value){
                            $("#settlement").append('<option></option>');
                            $("#settlement").append('<option value="'+value.id+'">'+value.id+'</option>');
                        });
                    }
                }else{
                    $("#settlement").empty();
                }
            }
        });
    };
</script>
