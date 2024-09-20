<li class="nav-item">
    <a href="#" class="nav-link">
        {{ $title }} AAAAAAAAAAAAAAAAAAAAAAAA
        <span class="{{ $c1 }}">
{{--            <i class="{{ $icon }}"></i>--}}
            @if ($witch === 'month')
                {{ number_format((new App\Classes\RiportsClass)->daysInvoicesResult(now()->subDays(30)->toDateString())->sum($field),0,",",".") }}
                Ft.
            @endif
            @if ($witch === 'amount')
                {{ number_format((new App\Classes\RiportsClass)->daysInvoicesResult(now()->subYear()->toDateString())->sum($field),0,",",".") }}
                Ft.
            @endif
        </span>
    </a>
</li>
