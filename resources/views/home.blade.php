@extends('layouts.app')

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
                        <button type="button" class="btn btn-secondary btn-lg btn-block">CONTINUE</button>
                        <button type="button" class="btn btn-primary btn-lg btn-block">NEW GAME</button>
                        <button type="button" class="btn btn-primary btn-lg btn-block">RANKING</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
