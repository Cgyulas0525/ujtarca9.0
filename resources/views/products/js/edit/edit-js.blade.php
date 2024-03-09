@section('scripts')
    @include('functions.ajax_js')
    @include('functions.sweetalert_js')
    @include('functions.productScript.priceControll')
    @include('products.js.edit.component-product-update')
    @include('products.js.edit.featue-product-update')
    @include('products.js.edit.components-table-js')
    @include('products.js.edit.features-table-js')
    @include('products.js.table.features-saving')

    <script type="text/javascript">
        $(function () {
            ajaxSetup();

            $('#price').change(function () {
                priceControll();
            });

            $('#supplierprice').change(function () {
                priceControll();
            });

            componentsTable();
            featuresTable();

            featuresSaving();
        });

    </script>
@endsection

