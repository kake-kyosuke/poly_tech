@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
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
                    <p><form action="{{ route('todo.list') }}" method="GET">
                    @csrf
                    <button class="button3_1">TODO一覧</button></form></p>

                    <form action="{{ route('user.list') }}" method="GET">
                    @csrf
                    <button class="button3_1">USER一覧</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
