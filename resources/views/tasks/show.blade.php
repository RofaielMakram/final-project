<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center"> 
          <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
              {{ $task->name }}
          </h2>
          <div class="flex space-x-2">
            @if(auth()->user()->isOwner())
            <form action="{{ route('tasks.destroy', $task) }}" method="POST">
              @method('DELETE')
              @csrf
              <button class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">Delete</button>
            </form>
            @endif
          
          @if(in_array(auth()->id(), [$task->assigned_to, $task->created_by]))
          <form action="{{ route('tasks.update', $task) }}" method="POST">
            @method('PATCH')
            @csrf

            @if(auth()->id() == $task->assigned_to && $task->status !== \App\Models\Task::INPROGRESS)
            <button onclick="if(!confirm('Are you sure?')) event.preventDefault()" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">
              Confirm
            </button>
            @elseif(auth()->id() == $task->created_by && $task->status !== \App\Models\Task::COMPLETED)
            <button onclick="if(!confirm('Are you sure?')) event.preventDefault()" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">
              Mark as Completed
            </button>
            @endif
          </form>
          @endif
        </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="px-4 sm:px-0">
                          <h3 class="text-base font-semibold leading-7 text-gray-900">Task Details</h3>
                        </div>
                        <div class="mt-6 border-t border-gray-100">
                          <dl class="divide-y divide-gray-100">
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                              <dt class="text-sm font-medium leading-6 text-gray-900">Title</dt>
                              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $task->name }}</dd>
                            </div>
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                              <dt class="text-sm font-medium leading-6 text-gray-900">Status</dt>
                              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                @if($task->status === \App\Models\Task::BACKLOG)
                                <span class="px-1 font-md rounded-md text-sm border border-gray-500 text-gray-500 bg-gray-200">{{ $task->status }}</span>
                                @elseif($task->status === \App\Models\Task::INPROGRESS)
                                <span class="px-1 font-md rounded-md text-sm border border-blue-500 text-blue-500 bg-blue-200">{{ $task->status }}</span>
                                @elseif($task->status === \App\Models\Task::COMPLETED)
                                <span class="px-1 font-md rounded-md text-sm border border-green-500 text-green-500 bg-green-200">{{ $task->status }}</span>
                                @else
                                <span class="px-1 font-md rounded-md text-sm border border-red-500 text-red-500 bg-red-200">{{ $task->status }}</span>
                                @endif
                              </dd>
                            </div>
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                              <dt class="text-sm font-medium leading-6 text-gray-900">Project</dt>
                              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $task->project->name }}</dd>
                            </div>
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                              <dt class="text-sm font-medium leading-6 text-gray-900">Author</dt>
                              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0 flex space-x-2 items-center">
                                <img src="https://ui-avatars.com/api/?rounded=true&name={{ $task->author->name }}">
                                <div>
                                    <p>{{ $task->author->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $task->author->email }}</p>
                                </div>
                              </dd>
                            </div>
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                              <dt class="text-sm font-medium leading-6 text-gray-900">Asginee</dt>
                              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0 flex space-x-2 items-center">
                                <img src="https://ui-avatars.com/api/?rounded=true&name={{ $task->asignee->name }}">
                                <div>
                                    <p>{{ $task->asignee->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $task->asignee->email }}</p>
                                </div>
                              </dd>
                            </div>
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                              <dt class="text-sm font-medium leading-6 text-gray-900">Description</dt>
                              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $task->description }}</dd>
                            </div>
                          </dl>
                        </div>
                      </div>
                      
            </div>
        </div>
    </div>
</x-app-layout>
