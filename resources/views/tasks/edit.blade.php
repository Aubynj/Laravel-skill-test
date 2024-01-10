@extends('layouts.app')

@section('content')
<div class="container">
    <div class="flex justify-center">
        <div class="flex flex-col h-screen w-1/2">
            <div class="p-3 bg-white rounded-md shadow-md">
                
                <div class="card-header">
                    <div class="row mb-4">
                        <h3 class="text-2xl text-center font-medium">Update Task</h3>    
                    </div>
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

                    <form method="POST" action="{{ route('tasks.update', ['id' => $task->task_id]) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <input class="form-control" type="text" name="name" value="{{ $task->name }}" placeholder="Name" required>
                        </div>

                        <div class="form-group">
                            <select class="form-control" name="project_id">
                                <option value="">-</option>
                                @foreach( $projects as $project )
                                    <option value="{{ $project->project_id }}">{{ $project->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="{{ route('tasks.index') }}" class="btn btn-warning">Cancel</a>
                    </form>
                    <div class="flex justify-end">
                        <form action="{{ route('tasks.destroy', ['id' => $task->task_id]) }}" method="POST" method="POST" class="delete">
                            @csrf
                            @method('DELETE')
                            <button type="submit" title="Delete Task" class="focus:outline-none p-1 bg-red-500 rounded-full">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-white">
                                    <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $('[name="user_id"]').val({{ $task->user_id }});
            $('[name="project_id"]').val({{ $task->project_id }});

            $('form.delete').on('submit', function(){
                if( !confirm("Do you want to delete this task?") )
                    return false;
            });
        });
    </script>
@endsection