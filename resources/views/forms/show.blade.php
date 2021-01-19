@extends(crudView('base'))

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> {{  trans('crud.create')  }}</div>
                        <div class="card-body">
                            <br>
                        <form-view slug="form1" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('script')
    @stack('fields_scripts')
@endsection

@section('style')
    @stack('fields_css')
@endsection





