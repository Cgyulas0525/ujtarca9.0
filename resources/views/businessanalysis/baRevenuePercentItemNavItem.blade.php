<li class="nav-item">
    <a href="#" class="nav-link">
        {{ $title }}
        <span class="{{ $c1 }}">
            <i class="{{ $icon }}"></i>
            {{ App\Services\YearstackedService::getSumPercent($field) }} %
        </span>
    </a>
</li>
