<div class="box box-primary" >
    <div class="box-body">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <section class="content-header">
                <div class="form-group col-sm-12">
                    <div class="row">
                        <h4>{{ $title }}</h4>
                    </div>
                </div>
            </section>
            @include('flash::message')
            <div class="clearfix"></div>
            <div class="box box-primary">
                <table @class([ $class ])></table>
                <div class="box-body"  >
                </div>
            </div>
            <div class="text-center"></div>
        </div>
    </div>
</div>
