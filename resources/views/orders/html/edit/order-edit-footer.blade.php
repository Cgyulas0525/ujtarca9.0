<div class="card-footer">
    @if (!isset($detail))
        <a href="#" class="btn btn-primary" id="otherBtn">Ment</a>
    @endif
    <a href="{{ route('orders.index') }}" class="btn btn-default">Kilép</a>
</div>
