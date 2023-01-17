<div class="col-lg-3 col-md-6 col-sm-12">
    <!-- small box -->
    <div class="{{ $box }}">
        <div class="inner">
            <h4>{{ $label }}: {{ $function }} {{ $endlabel }}</h4>
            <p>{{ $title }}</p>
        </div>
        <div class="icon">
            <i class="{{ $icon }}"></i>
        </div>
        <a href="{{ route($route) }}" class="small-box-footer">{{ $title }} <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
