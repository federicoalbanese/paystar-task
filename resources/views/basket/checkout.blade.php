<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Check Out') }}
        </h2>
    </x-slot>
    <div class="container mx-auto mt-5">
        <div class="overflow-hidden bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100">Payment Information  (Number : #{{$invoice->getNumber()}})</h3>
            </div>
            <div class="border-t dark:bg-slate-800 border-gray-200">
                <dl>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Product Name</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{$invoiceItem->getName()}}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">quantity</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">1</dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Price</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">ريال {{number_format($invoiceItem->getPrice())}}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Description</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{$invoiceItem->getDescription()}}</dd>
                    </div>
                    <div class="bg-white dark:bg-gray-800 shadow-sm py-5">
                        <a href="{{route('basket.pay', $invoice)}}" class="btn-primary">Pay (Final Price : {{$invoice->getFinalPrice()}})</a>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</x-app-layout>