<section class="content-header">
    <div class="form-group col-sm-12">
        <div class="row">
            <h4>{{ $title }}</h4>
            @if (isset($otherFields))
                @include($otherFields)
            @endif
        </div>
    </div>
</section>
