@extends('layouts.app')

@section('content')
<div class="container">
    <div class="flex justify-center">
        <div class="flex flex-col h-screen w-1/2">
            <div class="p-3 bg-white rounded-md shadow-md">
                <h3 class="text-2xl text-center font-medium">Create Project</h3>    

                <div class="card-body">
                    @if(count($errors)>0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>
                                        <small class="text-red-500 font-medium">
                                            {{$error}}
                                        </small>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" class="p-3" action="{{ route('projects.store') }}">
                        @csrf

                        <div class="form-group">
                            <input class="form-control" type="text" name="name" placeholder="Name" value="{{ old('name') }}" required>
                        </div>

                        <div class="flex items-center form-group">
                            <button type="submit" class="btn btn-success">Create</button>
                            <a href="{{ route('projects.index') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection