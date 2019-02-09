@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @for ($i = 1; $i <= 10; $i++)
                            <div class="row">
                                <div class="container offset-1">
                                    <div class="btn-group">
                                        @for ($j = 'A'; $j <= 'J'; $j++)
                                            <a class="btn btn-light btn-lg" data-toggle="tooltip" data-placement="top" title="{{"({$i}, {$j})"}}"><i class="fa fa-bomb" aria-hidden="true"></i></a>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection

