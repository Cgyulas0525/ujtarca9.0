<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="features-table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($features as $feature)
                <tr>
                    <td>{{ $feature->name }}</td>
                    <td>{{ $feature->description }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['features.destroy', $feature->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('features.show', [$feature->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('features.edit', [$feature->id]) }}"
                               class='btn btn-default btn-xs'>
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

    <div class="card-footer clearfix">
        <div class="float-right">
            @include('adminlte-templates::common.paginate', ['records' => $features])
        </div>
    </div>
</div>
