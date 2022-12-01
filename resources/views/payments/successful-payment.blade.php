<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-600 dark:text-green-400 leading-tight">
            {{ __('Successful payment') }}
        </h2>
    </x-slot>
    <div class="container mx-auto mt-5">
        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">message</dt>
            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{$payment->getMessage()}}</dd>
        </div>
        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">status</dt>
            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{$payment->getStatus()}}</dd>
        </div>
    </div>
</x-app-layout>