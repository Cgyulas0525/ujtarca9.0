<div class="table-responsive">
    <table class="table" id="closures-table">
        <thead>
            <tr>
                <th>Closuredate</th>
        <th>Card</th>
        <th>Szcard</th>
        <th>Dayduring</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($closures as $closures)
            <tr>
                <td>{{ $closures->closuredate }}</td>
            <td>{{ $closures->card }}</td>
            <td>{{ $closures->szcard }}</td>
            <td>{{ $closures->dayduring }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['closures.destroy', $closures->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('closures.show', [$closures->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('closures.edit', [$closures->id]) }}" class='btn btn-default btn-xs'>
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
