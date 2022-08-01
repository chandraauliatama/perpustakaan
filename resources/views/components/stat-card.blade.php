<div class="flex items-center p-4 bg-white rounded-lg shadow-xs ">
    {{ $slot }}
    <div>
        <p class="mb-2 text-sm font-medium text-gray-600 ">
            {{ $title ?? 'Title' }}
        </p>
        <p class="text-lg font-semibold text-gray-700 ">
            {{ $stat ?? '200' }}
        </p>
    </div>
</div>
