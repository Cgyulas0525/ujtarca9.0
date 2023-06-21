<li class="nav-item">
    <a href="#" class="nav-link">
        {{ $title }}
        <span class="{{ $c1 }}">
{{--            <i class="{{ $icon }}"></i>--}}
            @if ($witch === 'month')
                {{ number_format((new App\Classes\RiportsClass)->daysInviocesResult(date('Y-m-d', strtotime('-30 day')))->sum($field),0,",",".") }} Ft.
            @endif
            @if ($witch === 'amount')
                {{ number_format((new App\Classes\RiportsClass)->daysInviocesResult(date('Y-m-d', strtotime('-365 day')))->sum($field),0,",",".") }} Ft.
            @endif
        </span>
    </a>
</li>
