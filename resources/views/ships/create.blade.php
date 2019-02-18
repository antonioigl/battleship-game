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
                                @if(App\Ship::isGameOver())
                                    <a href="{{route('ships.create')}}" class="btn btn-primary">NEW GAME</a>
                                @else
                                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#resetGameModal">RESET GAME</button>
                                @endif
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
    @include('modals.reset-game')
@endsection

@section('script')
    <script src="{{ asset('js/play.js') }}"></script>
@endsection

