@extends('layouts.app')

@section('content')
<div class="container">
    <div class="flex justify-center">
        <div class="flex flex-col h-screen w-1/2">
            <div class="p-3 bg-white rounded-md shadow-md">
                <div class="card-header">
                    <div class="row mb-4">
                        <h3 class="text-2xl text-center font-medium">Projects</h3>    
                    </div>
                </div>

                <div class="card-body">
                    @if( $projects->count() > 0 )
                        <ul class="list-group tasks" id="sortable">
                            @foreach( $projects as $project )
                                <li class="list-group-item">
                                    <div class="flex justify-between items-center">
                                        <div class="">{{ $project->name }}</div>
                                        <div class="flex justify-between gap-3 items-center">
                                            <a class="p-1 bg-blue-500 rounded-full text-blue-300" href="{{ route('projects.edit', ['id' => $project->project_id]) }}">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-white">
                                                    <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                                                    </svg>
                                                </span>
                                            </a>
                                            <div class="col-auto">
                                                <form action="{{ route('projects.destroy', ['id' => $project->project_id]) }}" class="delete" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" title="Delete Project" class="focus:outline-none p-1 bg-red-500 rounded-full">
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
                                </li>
                            @endforeach
                        </ul>
                        <div class="mt-10">
                            <p class="text-sm"><a class="text-blue-500 underline" href="{{ route('projects.create') }}">Create another project.</a></p>
                        </div>
                    @else
                        <p class="text-sm">There are no projects yet, <a class="text-blue-500 underline" href="{{ route('projects.create') }}">Create new project here.</a></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $('form.delete').on('submit', function(){
                if( !confirm("Do you want to delete this project?") )
                    return false;
            });
        });
    </script>
@endsection
