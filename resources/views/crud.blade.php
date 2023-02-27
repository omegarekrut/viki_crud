@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('CRUD') }}</div>
                    <div class="card-body">
                        <x-crud-table>

                        </x-crud-table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js_scripts')
@endsection
