<div
    x-data="{ show: true }"
    x-show="show"
    x-init="setTimeout(() => show = false, 4000)"
    class="fixed top-5 right-5 z-50 flex items-center gap-2 px-4 py-3 rounded-md shadow-lg
           {{ session('type') === 'error' ? 'bg-red-600 text-white' : 'bg-green-600 text-white' }}"
>
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
         stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="{{ session('type') === 'error'
                     ? 'M6 18L18 6M6 6l12 12'
                     : 'M5 13l4 4L19 7' }}" />
    </svg>
    <span class="text-sm font-medium">{{ session('message') }}</span>
</div>
