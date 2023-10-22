<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('New Project') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('projects.store') }}" class="grid grid-cols-2 gap-4">
                        {{ csrf_field() }}
                        <div class="col-span-1">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"  autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                
                        <div class="col-span-1">
                            <x-input-label for="description" :value="__('Description')" />
                            <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" />
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                
                        <div class="col-span-1">
                            <x-input-label for="start_at" :value="__('Start At')" />
                
                            <x-text-input id="start_at" class="block mt-1 w-full"
                                            type="date"
                                            name="start_at"
                                            />
                
                            <x-input-error :messages="$errors->get('start_at')" class="mt-2" />
                        </div>

                        <div class="col-span-1">
                            <x-input-label for="end_at" :value="__('End At')" />
                
                            <x-text-input id="end_at" class="block mt-1 w-full"
                                            type="date"
                                            name="end_at"
                                            />
                
                            <x-input-error :messages="$errors->get('end_at')" class="mt-2" />
                        </div>
                
                        <div class="col-span-full text-center">
                            <x-primary-button class="ml-4">
                                {{ __('Create') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
