<script type="text/javascript">

    function requiredField(field, title) {
        var targetField = $('#' + field);
        var value = targetField.val();
        if (value.length === 0 || value === '0') {
            // if (value.trim() === '' || value === '0') {
                targetField.focus();
                sw(title + ' kötelező mező!');
                return false;
            // }
        }
        return true;
    }
</script>



