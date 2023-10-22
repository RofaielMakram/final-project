<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $project->name }}
            </h2>

            <div class="flex space-x-2">
            @if(auth()->user()->isOwner())
                <a href="{{ route('projects.edit', $project) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Edit</a>
                <form action="{{ route('projects.destroy', $project) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">Delete</button>
                </form>
            @endif
            <a href="{{ route('tasks.create', $project) }}" class="text-white bg-orange-700 hover:bg-orange-800 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-orange-600 dark:hover:bg-orange-700 focus:outline-none dark:focus:ring-orange-800">New Task</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            @foreach($tasks as $task)
                <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex justify-between items-center">
                        <a href="{{ route('tasks.show', $task) }}">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $task->name }}</h5>
                        </a>
                        @if($task->status === \App\Models\Task::BACKLOG)
                        <span class="px-1 font-md rounded-md text-sm border border-gray-500 text-gray-500 bg-gray-200">{{ $task->status }}</span>
                        @elseif($task->status === \App\Models\Task::INPROGRESS)
                        <span class="px-1 font-md rounded-md text-sm border border-blue-500 text-blue-500 bg-blue-200">{{ $task->status }}</span>
                        @elseif($task->status === \App\Models\Task::COMPLETED)
                        <span class="px-1 font-md rounded-md text-sm border border-green-500 text-green-500 bg-green-200">{{ $task->status }}</span>
                        @else
                        <span class="px-1 font-md rounded-md text-sm border border-red-500 text-red-500 bg-red-200">{{ $task->status }}</span>
                        @endif
                    </div>
                    <div class="mt-4 border-t pt-4 text-sm text-gray-500 flex justify-between">
                        <span><strong>Author:</strong> {{ $task->author->name }}</span> 
                        <span><strong>Asignee:</strong> {{ $task->asignee->name }}</span>
                    </div>
                </div>
            @endforeach
            </div>
            {{ $tasks->links() }}
        </div>
    </div>
</x-app-layout>
