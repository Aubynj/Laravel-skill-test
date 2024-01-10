@extends('layouts.app')

@section('content')
<div class="container">
    <div class="flex justify-center">
        <div class="flex flex-col h-full w-1/2">
            <div class="p-3 bg-white rounded-md shadow-md">
                <div class="card-header">
                    <div class="row">
                        <div class="col">All Tasks</div>
                        <div class="col-auto mt-3">
                            <select class="select-control" name="projects">
                                <option value="" selected disabled>- All Projects -</option>
                                @foreach( $projects as $project )
                                    <option value="{{ $project->project_id }}">{{ $project->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="card-body mt-4 mb-4">
                    @if( $tasks->count() > 0 )
                        <ul class="list-group tasks" id="sortable">
                            @foreach( $tasks as $task )
                                <li class="list-group-item" data-task-id="{{ $task->task_id }}" data-project-id="{{ $task->project ? $task->project->project_id : '' }}">
                                <div class="flex justify-between">
                                        <div class="flex">{{ $task->name }} | {{ $task->project ? $task->project->name : '' }}</div>
                                        <div class="flex gap-3">
                                            <div class="flex">
                                                <a class="flex justify-center items-center p-2 bg-blue-500 rounded-full text-blue-300" href="{{ route('tasks.edit', ['id' => $task->task_id]) }}">
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-white">
                                                        <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                                                        </svg>
                                                    </span>
                                                </a>
                                            </div>    
                                            <form action="{{ route('tasks.destroy', ['id' => $task->task_id]) }}" method="POST">
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
                                </li>
                            @endforeach
                        </ul>
                        <div class="mt-10">
                            <p class="text-sm"><a class="text-blue-500 underline" href="{{ route('tasks.create') }}">Create another task.</a></p>
                        </div>
                    @else
                        <p class="text-sm">There are no tasks yet, <a class="text-blue-500 underline" href="{{ route('tasks.create') }}">Create new task here.</a></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        var taskList = $('.tasks li') // store in memory

        $("#sortable").sortable({
            stop: function( event, ui ) {
                var $currentItem  = $(ui.item);
                var $prevItem = $currentItem.prev();
                var $nextItem = $currentItem.next();

                console.log($currentItem.data('task-id'), ' prev:', $prevItem.data('task-id'), ' next::', $nextItem.data('task-id'))

                $.ajax({
                    url: "{{ route('tasks.setPriority') }}",
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        _token: '{{ csrf_token() }}',
                        task_id: $currentItem.data('task-id'),
                        prev_id: $prevItem ? $prevItem.data('task-id') : null,
                       next_id: $nextItem ? $nextItem.data('task-id') : null
                    } 
                });
            }
        });

        $('[name="projects"]').on('change', function(){
            var $this = $(this);
            
            if( $this.val() ){
                $('.tasks li').hide();
                
                taskList
                    .filter( $(`[data-project-id="${$this.val()}"]`) )
                    .show();

                return;
            }

        });
    </script>
@endsection