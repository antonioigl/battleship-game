@extends('layouts.app')
@section('title', 'Play')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Game</div>

                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <p> Destroyer: 2 size | Submarine: 3 size | Battleship: 4 size | Carrier: 5 size</p>
                                <p> Total shots: <span id="total-shots"> 0</span> </p>
                            </div>
                            <div class="offset-md-3 col-md-3">

                                <a href="{{route('home')}}" class="btn btn-primary">GO HOME</a>
                                <a href="" class="btn btn-secondary">RESET GAME</a>
                            </div>
                        </div>

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
                                            <button type="button" class="btn btn-block btn-light" onclick="fire({{$k}},{{$j}})"  id="{{$k}}{{$j}}" data-toggle="tooltip" data-placement="top" title="{{"({$i}, {$k})"}}">
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
    @include('modals.game-over')
@endsection

@section('script')

    <script>
        const totalSizeShips = 14;

        function fire(x, y) {

            $('button').prop('disabled',true);
            var id = x.toString() + y.toString();
            $('#' + id).children('i').remove();
            $('#' + id).append( "<i class=\"fa fa-spinner fa-spin\"></i>" );

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajaxSetup({async: false});
            $.post('/shots',
                {
                    _token: CSRF_TOKEN,
                    data: {x: x, y: y}
                },
                function(data,status){
                    $('#' + id).removeClass('btn-light');
                    $('#' + id).children('i').removeClass('fa-spinner');
                    $('#' + id).children('i').removeClass('fa-spin');

                    //success
                    if (data.state){
                        // sunken ship
                        if (data.ship['length'] == data.ship['shot_counter']){
                            var axisXship = data.ship['x'];
                            var axisYship = data.ship['y'];

                            for (var i = 0; i < data.ship['length']; i++){
                                var axisId = axisXship.toString() + axisYship.toString();
                                $('#' + axisId).removeClass('btn-warning');
                                $('#' + axisId).addClass('btn-danger');
                                $('#' + axisId).children('i').removeClass('fa-bomb');
                                $('#' + axisId).children('i').addClass('fa-ship');

                                if (data.ship['axis'] === 'H'){
                                    axisXship++;
                                }
                                else {
                                    axisYship++;
                                }
                            }
                        }
                        //boat fired
                        else {
                            $('#' + id).addClass('btn-warning');
                            $('#' + id).children('i').removeClass('fa-bomb');
                            $('#' + id).children('i').addClass('fa-ship');
                        }
                    }
                    //water
                    else {
                        //add class primary if not has class danger or warning
                        if (!($('#' + id).hasClass('btn-danger') || $('#' + id).hasClass('btn-warning'))) {
                            $('#' + id).addClass('btn-primary');
                        }
                        else {
                            $('#' + id).children('i').addClass('fa-ship');
                        }
                    }
                    $('button').prop('disabled',false);
                    $('#total-shots').text(data.shotsCount.toString());
                }
            );

            var shots = totalSizeShips/parseInt($('#total-shots').text());
            $('#score').html(shots.toFixed(4));

            $('#gameOverModalCenter').on('hidden.bs.modal', function(){
                $('button').prop('disabled',true);
            });

            $.get('/ships/game-over', function(response){
                if (response.gameOver){
                    $('#gameOverModalCenter').modal();
                }
            });
        }



        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
            $('button').prop('disabled',true);

            //get request paint shots user login.
            // if ship_id is not null is success else is water
            $.ajaxSetup({async: false});
            $.get('/shots/my-shots', function(response){

                if(response.shots.length){
                    for (var i = 0; i < response.shots.length; i++){

                        var x = response.shots[i]['x'];
                        var y = response.shots[i]['y'];
                        var id = x.toString() + y.toString();
                        var shipId = response.shots[i]['ship_id'];

                        $('#' + id).removeClass('btn-light');

                        //success
                        if (shipId){
                            $('#' + id).addClass('btn-warning');
                            $('#' + id).children('i').addClass('fa-ship');
                        }
                        //water
                        else {
                            $('#' + id).children('i').removeClass('fa-bomb');
                            $('#' + id).addClass('btn-primary');
                        }
                    }

                    $('#total-shots').text(response.shots.length.toString());
                }
                $('button').prop('disabled',false);
            });


            // get request sunken ships to paint sunken ships
            $.get('/ships/my-ships', function(response){

                if(response.ships.length){
                    for (var i = 0; i < response.ships.length; i++){

                        var x = response.ships[i]['x'];
                        var y = response.ships[i]['y'];
                        var axis = response.ships[i]['axis'];
                        var length = response.ships[i]['length'];
                        var shot_counter = response.ships[i]['shot_counter'];

                        if (length == shot_counter){
                            for (var j = 0; j < length; j++){
                                var axisId = x.toString() + y.toString();
                                $('#' + axisId).removeClass('btn-warning');
                                $('#' + axisId).addClass('btn-danger');
                                $('#' + axisId).children('i').addClass('fa-ship');

                                if (axis === 'H'){
                                    x++;
                                }
                                else {
                                    y++;
                                }
                            }
                        }
                    }
                }
                $('button').prop('disabled',false);
            });

            var shots = totalSizeShips/parseInt($('#total-shots').text());
            $('#score').html(shots.toFixed(4));

            $('#gameOverModalCenter').on('hidden.bs.modal', function(){
                $('button').prop('disabled',true);
            });

            $.get('/ships/game-over', function(response){
                if (response.gameOver){
                    $('#gameOverModalCenter').modal();
                }
            });
        });

    </script>
@endsection

