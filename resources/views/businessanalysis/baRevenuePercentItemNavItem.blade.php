<li class="nav-item">
    <a href="#" class="nav-link">
        {{ $title }}
        <span class="{{ $c1 }}">
            @if ($witch === 'all')
                {{ $dataArray['yearStacked'][$field] }} %
            @endif
            @if ($witch === 'year')
                {{ $dataArray['monthStacked'][$field] }} %
            @endif
        </span>
    </a>
</li>
