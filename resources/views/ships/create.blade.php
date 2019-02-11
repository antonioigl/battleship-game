@extends('layouts.app')
@section('title', "Play")

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Game</div>

                    <div class="card-body">
                        <table class="table table-bordered table-condensed">
                            <thead>
                            <tr>
                                <th>#</th>
                                @for ($i = 1; $i <= 10; $i ++)
                                    <th>{{$i}}</th>
                                @endfor
                            </tr>
                            </thead>
                            <tbody>
                            @for ($i = 'A', $j = 1; $i <= 'J'; $i ++, $j++)
                                <tr>
                                    <td>{{$i}}</td>
                                    @for ($k = 1; $k <= 10; $k ++)
                                        <td>
                                            <button class="btn btn-block btn-light" onclick="fire({{$j}},{{$k}})"  id="{{$j}}{{$k}}" data-toggle="tooltip" data-placement="top" title="{{"({$i}, {$j})"}}">
                                                <i class="fa fa-bomb"></i>
                                            </button>
                                        </td>
                                    @endfor
                                </tr>
                            @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script>
        function fire(row, col) {

            var id = row.toString() + col.toString();
            $('#' + id).children('i').remove();
            $('#' + id).append( "<i class=\"fa fa-spinner fa-spin\"></i>" );

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.post("/shots",
                {
                    _token: CSRF_TOKEN,
                    data: {row: row, col: col}
                },
                function(data,status){
                    $("#" + id).removeClass('btn-light');
                    $("#" + id).addClass('btn-primary');
                    $("#" + id).children('i').removeClass("fa-spinner");
                    $("#" + id).children('i').removeClass("fa-spin");
                    $("#" + id).children('i').addClass("fa-ship");
                }
            );
        }

        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });

    </script>
@endsection

