<div class="table-responsive">
    <table class="table" id="paymentMethods-table">
        <thead>
            <tr>
                <th>Name</th>
        <th>Description</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($paymentMethods as $paymentMethods)
            <tr>
                <td>{{ $paymentMethods->name }}</td>
            <td>{{ $paymentMethods->description }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['paymentMethods.destroy', $paymentMethods->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('paymentMethods.show', [$paymentMethods->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('paymentMethods.edit', [$paymentMethods->id]) }}" class='btn btn-default btn-xs'>
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
