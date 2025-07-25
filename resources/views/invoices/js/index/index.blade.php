@section('scripts')
    <script type="text/javascript">
        $(function () {
            ajaxSetup();
            var table = indexTable();

            const routes = {
                referred: "{{ route('notReferredInvoicesIndex', ['year' => session("invoiceYear"),
                                            'partner' => session("invoicePartner")]) }}",
                referredPaid: "{{ route('invoicesIndex', ['year' => session("invoiceYear"),
                                            'partner' => session("invoicePartner")]) }}"
            };

            const currentRoute = "{{ Route::currentRouteName() }}";
            console.log(currentRoute);
            if (currentRoute === "invoicesIndex") {
                $('#referredBtn').text('Utalatlan');
                url = routes.referredPaid;
                putSession("invoiceReferred", "No");

            }
            if (currentRoute === "notReferredInvoicesIndex") {
                $('#referredBtn').text('Mind');
                url = routes.referred;
                putSession("invoiceReferred", "Yes");
            }

            table.ajax.url(url).load();

            filterBtnTopClick(table);
            referredBtnClick(table);
        });
    </script>
@endsection
