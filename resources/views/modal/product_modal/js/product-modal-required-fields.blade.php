<script type="text/javascript">
    function productModalRequiredFields() {
        if (requiredField('email', 'Email')) {
            if (requiredField('name', 'Név')) {
                if (requiredField('partnertypes_id', 'Típus')) {
                    if (requiredField('postcode', 'Irányító szám')) {
                        if (requiredField('settlement_id', 'Település')) {
                            requiredField('address', 'Cím');
                        }
                    }
                }
            }
        }
        return true;
    }
</script>
