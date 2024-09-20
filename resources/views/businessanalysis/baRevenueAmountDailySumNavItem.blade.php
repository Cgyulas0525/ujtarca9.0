<li class="nav-item">
    <a href="#" class="nav-link">
        {{ $title }}
        <span class="{{ $c1 }}">
            @if ($witch === 'month')
                {{ number_format($dataArray['reports']['daysInvoicesResult30']->sum($field),0,",",".") }}
                Ft.
            @endif
            @if ($witch === 'amount')
                {{ number_format($dataArray['reports']['daysInvoicesResult']->sum($field),0,",",".") }}
                Ft.
            @endif
        </span>
    </a>
</li>
