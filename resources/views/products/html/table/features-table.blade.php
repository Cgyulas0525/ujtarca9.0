<div class="form-group col-sm-6">
    @include('app-scaffold.html.table.table', [
                'title' => 'Jellemzők',
                'class' => 'table table-hover table-bordered f_table w-100',
                'otherFields' => 'products.html.table.features-otherfields'
            ])
</div>
