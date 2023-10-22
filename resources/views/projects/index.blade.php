<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Projects') }}
            </h2>

            @if(auth()->user()->isOwner())
                <a href="{{ route('projects.create') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">New Project</a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            @foreach($projects as $project)
                <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <a href="{{ route('projects.show', $project) }}">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $project->name }}</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $project->description }}</p>
                    <span class="text-sm text-gray-500 flex justify-end">
                        <span>{{ $project->start_at->format('d, M y') }}</span> 
                        <span class="mx-2">to</span>
                        <span>{{ $project->end_at?->format('d, M y') ?? 'Now' }}</span>
                    </span>
                </div>
            @endforeach
            </div>

            {{ $projects->links() }}
        </div>
    </div>
</x-app-layout>
