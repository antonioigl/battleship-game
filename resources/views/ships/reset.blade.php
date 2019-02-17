@extends('layouts.app')
@section('title', 'Reset')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Reset Game</div>

                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <p> Destroyer: 2 size | Submarine: 3 size | Battleship: 4 size | Carrier: 5 size</p>
                            </div>
                            <div class="offset-md-4 col-md-2">
                                <a href="{{route('home')}}" class="btn btn-primary">GO HOME</a>
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
                                            <button type="button" class="btn btn-block btn-primary" id="{{$k}}{{$j}}" data-toggle="tooltip" data-placement="top" title="{{"({$i}, {$k})"}}">
                                                <i class="fa fa-spin fa-spinner"></i>
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

        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
            $('button').prop('disabled',true);

            // get request sunken ships to paint sunken ships
            $.get('/ships/my-ships', function(response){
                $('button').children('i').removeClass('fa-spinner');
                $('button').children('i').removeClass('fa-spin');
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
                                $('#' + axisId).removeClass('btn-primary');
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
            });
        });

    </script>
@endsection



