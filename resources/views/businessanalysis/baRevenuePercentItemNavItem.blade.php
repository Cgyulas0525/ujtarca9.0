<li class="nav-item">
    <a href="#" class="nav-link">
        {{ $title }}
        <span class="{{ $c1 }}">
            @if ($witch === 'all')
                {{ (new App\Services\YearstackedService)->getSumPercent($field) }} %
            @endif
            @if ($witch === 'year')
                {{ (new App\Services\MonthstackedService)->getSumPercent($field) }} %
            @endif
        </span>
    </a>
</li>
