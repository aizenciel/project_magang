<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Item Details') }}
            </h2>
            <div>
                <a href="{{ route('items.edit', $item) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mr-2">
                    Edit
                </a>
                <a href="{{ route('items.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back to List
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Basic Information</h3>
                            <dl class="mt-4 space-y-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Item Code</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $item->item_code }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">INC</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $item->inc }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Item Type</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $item->item_type }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Item Group</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $item->item_group }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">UoM</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $item->uom }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Denotation</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $item->denotation }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Key Word</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $item->key_word }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Description</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $item->description }}</dd>
                                </div>
                            </dl>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Additional Information</h3>
                            <dl class="mt-4 space-y-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Old Code</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $item->old_code }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Unit Price</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ number_format($item->unit_price, 2) }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Main Supplier</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $item->main_supplier }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Storage Location</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $item->storage_location }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Max Stock Level</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ number_format($item->max_stock_level, 2) }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Reorder Point</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ number_format($item->reorder_point, 2) }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    @if($item->image_path)
                        <div class="mt-8">
                            <h3 class="text-lg font-medium text-gray-900">Item Image</h3>
                            <div class="mt-4">
                                <img src="{{ Storage::url($item->image_path) }}" alt="Item Image" class="max-w-lg rounded-lg shadow-lg">
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 