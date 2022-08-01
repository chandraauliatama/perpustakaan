<div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
    {{ $slot }}
    <div>
        <p class="mb-2 text-sm font-bold text-gray-600 dark:text-gray-400">
            {{ $title ?? 'Title' }}
        </p>
        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
            {{ $stat ?? '200' }}
        </p>
    </div>
</div>
