<div class="table-responsive">
    <table class="table" id="offers-table">
        <thead>
            <tr>
                <th>Offernumber</th>
        <th>Offerdate</th>
        <th>Partners Id</th>
        <th>Description</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($offers as $offers)
            <tr>
                <td>{{ $offers->offernumber }}</td>
            <td>{{ $offers->offerdate }}</td>
            <td>{{ $offers->partners_id }}</td>
            <td>{{ $offers->description }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['offers.destroy', $offers->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('offers.show', [$offers->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('offers.edit', [$offers->id]) }}" class='btn btn-default btn-xs'>
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
