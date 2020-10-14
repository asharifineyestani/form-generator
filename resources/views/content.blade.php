@extends(crudView('base'))

@section('content')
    <div class="container-fluid">
                <{{$field['name']}}></{{$field['name']}}>
    </div>
@endsection

@section('script')
    @stack('fields_scripts')
@endsection

@section('style')
    @stack('fields_css')
@endsection





