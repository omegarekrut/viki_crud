@extends('layouts.app')

@section('css_links')
    <link href="{{ asset('css/datatables.min.css') }}" />
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('CRUD') }}</div>
                    <div class="card-body">
                        <button class="btn btn-primary" id="addbutton" title="Add"><i class="bi bi-plus-square"></i></button>
                        <table class="table dataTable table-striped" id="crud_output_table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>JSON</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js_scripts')
    <script>
        const token = "{{ csrf_token() }}";
    </script>
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.altEditor.free.js') }}"></script>
    <script src="{{ asset('js/crud_datatable.js') }}"></script>
@endsection
