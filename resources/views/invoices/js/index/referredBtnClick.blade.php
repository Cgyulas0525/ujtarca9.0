<script type="text/javascript">

    const routes = {
        referred: "{{ route('notReferredInvoicesIndex', ['year' => session("invoiceYear"),
                                            'partner' => session("invoicePartner")]) }}",
        referredPaid: "{{ route('invoicesIndex', ['year' => session("invoiceYear"),
                                            'partner' => session("invoicePartner")]) }}"
    };

    function referredBtnClick(table) {
        $('#referredBtn').click(function () {
            const btnText = $(this).text().trim();

            let url;
            if (btnText === 'Utalatlan') {
                url = routes.referred;
                $(this).text('Mind');
                putSession("invoiceReferred", "Yes");
            } else {
                url = routes.referredPaid;
                $(this).text('Utalatlan');
                putSession("invoiceReferred", "No");
            }

            table.ajax.url(url).load();
        });
    }

</script>

