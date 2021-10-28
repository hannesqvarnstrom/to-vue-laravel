@extends('layouts.app')

@section('content')
<div class="container">
    <script>
        const token = document.querySelector('meta[name="csrf-token"]').content;
        const fetchOptions = (body, method = 'GET') => ({
            method,
            body,
            headers: {
                'X-CSRF-TOKEN': token
            }
        });

        const apiFetch = (url, body, method = 'GET') => {
            return fetch(url, {body, method, headers: {
                    'X-CSRF-TOKEN': token,                     
                    'content-type': 'application/json',
                    'accepts': 'application/json'
                    }}).then(data => data.json())
        }
    </script>
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
                        <h1>Welcome to the Todo Vue app! (made in Laravel)</h1>



                    @foreach(Auth::user()->todo_lists as $list)
                        <p>id: {{$list->id}}, title: {{$list->title}}</p>
                    @endforeach

                    {{-- <form method="post" action="{{route('todo-lists.store')}}">
                        @csrf
                        REGULAR WEB POST FORM
                        <input type="text" name="title" placeholder="Title"/>
                        <button type="submit">Submit</button>
                    </form> --}}
                    <todolists url="{{route('todo-lists.index')}}"></todolists>
                    {{-- <create-todolist url="{{route('todo-lists.store')}}"></create-todolist> --}}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
