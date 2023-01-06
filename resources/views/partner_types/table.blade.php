<div class="table-responsive">
    <table class="table" id="partnerTypes-table">
        <thead>
            <tr>
                <th>Name</th>
        <th>Description</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($partnerTypes as $partnerTypes)
            <tr>
                <td>{{ $partnerTypes->name }}</td>
            <td>{{ $partnerTypes->description }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['partnerTypes.destroy', $partnerTypes->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('partnerTypes.show', [$partnerTypes->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('partnerTypes.edit', [$partnerTypes->id]) }}" class='btn btn-default btn-xs'>
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
