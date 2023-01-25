function modifyValueFromApi(api, parameter, field) {
    let SITEURL = "{{url('/')}}";
    let url = SITEURL + '/' + api;
    $.ajax({
        type: "GET",
        url: url,
        data: { witch: parameter},
        success: function (response) {
            $(field).val(currencyFormatDE(parseInt(response)));
        },
        error: function (response) {
            alert('nem ok');
        }
    });
}
