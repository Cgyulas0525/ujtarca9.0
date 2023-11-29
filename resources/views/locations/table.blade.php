<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="locations-table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Postcode</th>
                <th>Settlement Id</th>
                <th>Address</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($locations as $location)
                <tr>
                    <td>{{ $location->name }}</td>
                    <td>{{ $location->description }}</td>
                    <td>{{ $location->postcode }}</td>
                    <td>{{ $location->settlement_id }}</td>
                    <td>{{ $location->address }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['locations.destroy', $location->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('locations.show', [$location->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('locations.edit', [$location->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $locations])
        </div>
    </div>
</div>
