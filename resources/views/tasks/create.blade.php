@extends('layouts.app')

@section('content')
<div class="container">
    <div class="flex justify-center">
        <div class="flex flex-col h-screen w-1/2">
            <div class="p-3 bg-white rounded-md shadow-md">
                <div class="card-header">
                    <h3 class="text-2xl text-center font-medium">Create Task</h3>    
                </div>

                <div class="card-body">
                    @if(count($errors)>0)
                        <div>
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

                    <form method="POST" class="p-3" action="{{ route('tasks.store') }}">
                        @csrf

                        <div class="form-group">
                            <input class="form-control" type="text" name="name" value="{{ old('name') }}" placeholder="Name" required>
                        </div>

                        <div class="form-group">
                            <select class="form-control" name="project_id">
                                <option selected disabled>Select Project</option>
                                @foreach( $projects as $project )
                                    <option value="{{ $project->project_id }}">{{ $project->name }}</option>
                                @endforeach
                            </select>
                            <small class="ml-2 text-gray-800">Don't have a project, <a class="underline text-blue-800 font-semibold" href="{{ route('projects.create') }}">create a new one</a></small>
                        </div>
                        
                        <div class="flex items-center form-group">
                            <button type="submit" class="btn btn-success">Create</button>
                            <a href="{{ route('tasks.index') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $('[name="project_id"]').val({{ old('project') }});
        });
    </script>
@endsection