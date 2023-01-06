<div class="table-responsive">
    <table class="table" id="cimlets-table">
        <thead>
            <tr>
                <th>Name</th>
        <th>Value</th>
        <th>Description</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($cimlets as $cimlets)
            <tr>
                <td>{{ $cimlets->name }}</td>
            <td>{{ $cimlets->value }}</td>
            <td>{{ $cimlets->description }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['cimlets.destroy', $cimlets->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('cimlets.show', [$cimlets->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('cimlets.edit', [$cimlets->id]) }}" class='btn btn-default btn-xs'>
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
