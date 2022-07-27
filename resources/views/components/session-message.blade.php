<div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2500)">
    <div class="text-green-500 font-bold mb-4">{{ session('status') }}</div>
    <div class="text-red-500 font-bold mb-4">{{ session('delete') }}</div>
</div>
