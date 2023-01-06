<div class="table-responsive">
    <table class="table" id="closureCimlets-table">
        <thead>
            <tr>
                <th>Closures Id</th>
        <th>Cimlets Id</th>
        <th>Value</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($closureCimlets as $closureCimlets)
            <tr>
                <td>{{ $closureCimlets->closures_id }}</td>
            <td>{{ $closureCimlets->cimlets_id }}</td>
            <td>{{ $closureCimlets->value }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['closureCimlets.destroy', $closureCimlets->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('closureCimlets.show', [$closureCimlets->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('closureCimlets.edit', [$closureCimlets->id]) }}" class='btn btn-default btn-xs'>
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
