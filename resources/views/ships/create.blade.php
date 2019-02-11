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
        function fire(x, y) {

            var id = x.toString() + y.toString();
            $('#' + id).children('i').remove();
            $('#' + id).append( "<i class=\"fa fa-spinner fa-spin\"></i>" );

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.post("/shots",
                {
                    _token: CSRF_TOKEN,
                    data: {x: x, y: y}
                },
                function(data,status){
                    $("#" + id).removeClass('btn-light');
                    $("#" + id).children('i').removeClass("fa-spinner");
                    $("#" + id).children('i').removeClass("fa-spin");

                    //success
                    if (data.state){
                        // sunken ship
                        if (data.ship['length'] == data.ship['shot_counter']){
                            var axisXship = data.ship['x'];
                            var axisYship = data.ship['y'];

                            for (var i = 0; i < data.ship['length']; i++){
                                var axisId = axisXship.toString() + axisYship.toString();
                                console.log(axisId);
                                $("#" + axisId).removeClass('btn-warning');
                                $("#" + axisId).addClass('btn-danger');
                                $("#" + axisId).children('i').addClass('fa-ship');

                                if (data.ship['axis'] === 'H'){
                                    axisYship++;
                                }
                                else {
                                    axisXship++;
                                }
                            }
                        }
                        //boat fired
                        else {
                            $("#" + id).addClass('btn-warning');
                            $("#" + id).children('i').addClass('fa-ship');
                        }
                    }
                    //water
                    else {
                        //add class primary if not has class danger or warning
                        if (!($("#" + id).hasClass('btn-danger') || $("#" + id).hasClass('btn-warning'))) {
                            $("#" + id).addClass('btn-primary');
                        }
                        else {
                            $("#" + id).children('i').addClass('fa-ship');
                        }
                    }

                }
            );
        }

        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });

    </script>
@endsection

