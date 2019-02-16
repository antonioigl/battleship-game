@extends('layouts.app')
@section('title', 'Home')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(auth()->user()->ships()->count())
                        <a href="{{route('ships.play')}}" class="btn btn-secondary btn-lg btn-block">CONTINUE</a>
                        <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#newGameModal">NEW GAME</button>
                    @else
                            <a href="{{route('ships.create')}}" class="btn btn-primary btn-lg btn-block">NEW GAME</a>
                    @endif
                    <a href="" class="btn btn-primary btn-lg btn-block">RANKING</a>
                </div>
            </div>
        </div>
    </div>
</div>
@include('modals.new-game')
@endsection

