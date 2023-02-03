<div class="table-responsive">
    <table class="table" id="offerdetails-table">
        <thead>
            <tr>
                <th>Offers Id</th>
        <th>Products Id</th>
        <th>Quantities Id</th>
        <th>Value</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($offerdetails as $offerdetails)
            <tr>
                <td>{{ $offerdetails->offers_id }}</td>
            <td>{{ $offerdetails->products_id }}</td>
            <td>{{ $offerdetails->quantities_id }}</td>
            <td>{{ $offerdetails->value }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['offerdetails.destroy', $offerdetails->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('offerdetails.show', [$offerdetails->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('offerdetails.edit', [$offerdetails->id]) }}" class='btn btn-default btn-xs'>
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
