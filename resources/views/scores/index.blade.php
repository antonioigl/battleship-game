@extends('layouts.app')
@section('title', 'Ranking')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Ranking</div>

                    <div class="card-body text-center">

                        <div class="row">
                            <div class="offset-md-9 col-md-3">
                                <a href="{{route('home')}}" class="btn btn-primary">GO HOME</a>
                                <a href="{{route('scores.show')}}" class="btn btn-primary">MY SCORES</a>
                            </div>
                        </div>

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Username</th>
                                    <th>Date</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($scores as $key => $score)
                                    <tr @if(auth()->user()->id == $score->user_id) class="table-primary" @endif>
                                        <td>{{$key+1}}</td>
                                        <td>{{$score->user->username}}</td>
                                        <td>{{$score->user->username}}</td>
                                        <td>{{$score->points}}</td>
                                        <td>{{$score->created_at}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
