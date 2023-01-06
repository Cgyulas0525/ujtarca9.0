<div class="table-responsive">
    <table class="table" id="invoices-table">
        <thead>
            <tr>
                <th>Partner Id</th>
        <th>Invoicenumber</th>
        <th>Paymentmethod Id</th>
        <th>Amount</th>
        <th>Dated</th>
        <th>Performancedate</th>
        <th>Deadline</th>
        <th>Description</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($invoices as $invoices)
            <tr>
                <td>{{ $invoices->partner_id }}</td>
            <td>{{ $invoices->invoicenumber }}</td>
            <td>{{ $invoices->paymentmethod_id }}</td>
            <td>{{ $invoices->amount }}</td>
            <td>{{ $invoices->dated }}</td>
            <td>{{ $invoices->performancedate }}</td>
            <td>{{ $invoices->deadline }}</td>
            <td>{{ $invoices->description }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['invoices.destroy', $invoices->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('invoices.show', [$invoices->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('invoices.edit', [$invoices->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
