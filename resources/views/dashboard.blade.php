@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <form class="m-5">
                        <div class="mb-3">
                            <label for="token" class="form-label">Token:</label>
                            <input type="text" class="form-control" id="token" name="token" required disabled>
                        </div>
                        <div class="mb-3">
                            <label for="choose_your_function" class="form-label">Method:</label>
                            <select class="form-select" id="choose_your_function" name="method">
                                <option value="neutral" selected disabled>options</option>
                                <option value="JSON">JSON</option>
                                <option value="instruction">instruction</option>
                            </select>
                        </div>
                        <div id="div_json" class="d-none">
                            <div class="mb-3">
                                <label for="method" class="form-label">Method:</label>
                                <select class="form-select" id="method" name="method">
                                    <option value="POST">POST</option>
                                    <option value="GET">GET</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="json" class="form-label">Data:</label>
                                <textarea class="form-control" id="json" name="json" rows="5" required></textarea>
                            </div>
                        </div>
                        <div id="div_instruction" class="mb-3 d-none">
                            <label for="instruction" class="form-label">Instruction:</label>
                            <textarea class="form-control" id="instruction" name="instruction" rows="2"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js_scripts')
    <script>
        $(document).ready(function() {
            $('#choose_your_function').change(function() {
                var selectedMethod = $(this).val();
                switch (selectedMethod) {
                    case 'JSON':
                        $('#div_json').removeClass("d-none");
                        $('#div_instruction').addClass("d-none");
                        $('#instruction').val("");
                        break;
                    case 'instruction':
                        $('#div_instruction').removeClass("d-none");
                        $('#div_json').addClass("d-none");
                        break;
                    default:
                        break;
                }
            });

            const token = '{{ csrf_token() }}';
            $('input[name="token"]').val(token);
            $("form").submit(function(e) {
                e.preventDefault();

                let method = $("#method").val();
                // let json = $("#json").val().replace(/\r?\n/g, '<br />');
                let instruction = $("#instruction").val();
                const option = $("#choose_your_function").val()

                $.ajax({
                    url: "/data",
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    data: JSON.stringify({
                        option: option,
                        json: json,
                        instructions: instruction
                    }),
                    contentType: "application/json",
                    success: function(response) {
                        console.log('success');
                    },
                    error: function(xhr, status, error) {
                        // handle error response here
                    },
                });
            });
        });
    </script>
@endsection
