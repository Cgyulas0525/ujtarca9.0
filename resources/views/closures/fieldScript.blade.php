@include('layouts.datatables_js')
<script src="{{ asset('/public/js/required.js') }} " type="text/javascript"></script>
<script src="{{ asset('/public/js/sweetalert.js') }} " type="text/javascript"></script>
<script src="{{ asset('/public/js/ajaxsetup.js') }} " type="text/javascript"></script>

<script type="text/javascript">

    var table;

    $(function () {

        $('[data-widget="pushmenu"]').PushMenu('collapse');

        ajaxSetup();

        RequiredBackgroundModify('.form-control')

        var closuresId = <?php echo isset($closures) ? $closures->id : -9999; ?>;

        function dailyAmount() {
            $.ajax({
                type:"GET",
                url:"{{url('closureCimletsSum')}}",
                data: { id: closuresId },
                success: function (response) {
                    $('#dailysum').val(parseInt($('#card').val()) + parseInt($('#szcard').val()) + parseInt($('#dayduring').val()) + parseInt(response));
                },
                error: function (response) {
                    // console.log('Error:', response);
                    alert('nem ok');
                }
            });
        }

        $('#card').change(function () {
            dailyAmount();
        });

        $('#szcard').change(function () {
            dailyAmount();
        });

        $('#dayduring').change(function () {
            dailyAmount();
        });

        table = $('.cimletstable').DataTable({
            serverSide: true,
            scrollY: 390,
            scrollX: true,
            order: [[2, 'asc']],
            paging: false,
            searching: false,
            select: false,
            ajax: "{{ route('closureCimletsIndex', ['id' => (isset($closures) ? $closures->id : -9999)]) }}",
            columns: [
                {title: 'Cimlet', data: 'cimletName', name: 'cimletName', id: 'cimletName' },
                {title: 'Érték', data: 'value', name: 'value', id: 'value'},
                {title: 'cimletValue', data: 'cimletValue', name: 'cimletValue', id: 'cimletValue'},
                {title: 'sumValue', data: 'sumValue', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", width:'150px', name: 'sumValue', id: 'sumValue'},
                {title: 'Id', data: 'id', name: 'id', id: 'id'},
            ],
            columnDefs: [
                {
                    targets: [2, 4],
                    visible: false
                },
                {
                    targets: [1],
                    sClass: 'text-right',
                    width:'150px',
                    render: function ( data, type, full, meta ) {
                        return '<input class="form-control text-right" type="number" value="'+ data +'" onfocusout="QuantityChange('+meta["row"]+', this.value)" pattern="[0-9]+([\.,][0-9]+)?" step="1" style="width:250px;height:20px;font-size: 15px;"/>';
                    },
                }
            ],
            buttons: []
        });
    });

    function QuantityChange(Row, value) {

        var d = table.row(Row).data();
        var out = parseInt($('#out').val());
        var dailysum = parseInt($('#dailysum').val());

        if ( d.value != value ) {

            out = out - (parseInt(d.value) * parseInt(d.cimletValue));
            dailysum = dailysum - (parseInt(d.value) * parseInt(d.cimletValue));

            d.value = value;
            d.sumValue = value * d.cimletValue;
            $('#out').val(out + parseInt(d.sumValue));
            $('#dailysum').val(dailysum + parseInt(d.sumValue))
            $.ajax({
                type:"GET",
                url:"{{url('closureCimletsUpdate')}}",
                data: { id: d.id, value: value },
                success: function (response) {
                    // console.log('Response:', response);
                },
                error: function (response) {
                    // console.log('Error:', response);
                    alert('nem ok');
                }
            });

            table.row(Row).invalidate();

        }
    }

</script>
