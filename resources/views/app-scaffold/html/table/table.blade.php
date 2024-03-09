<div class="box box-primary">
    <div class="box-body">
        <div class="col-lg-12 col-md-12 col-xs-12">
            @include('app-scaffold.html.table.content-header', ['title' => $title])
            @include('flash::message')
            @include('app-scaffold.html.table.table-box-primary', ['class' => $class])
        </div>
    </div>
</div>
