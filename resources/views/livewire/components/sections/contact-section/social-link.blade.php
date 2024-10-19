<a href="{{ $link }}"
   target="_blank"
   class="bg-[#292C34] h-68 w-[400px] flex items-center justify-between rounded-md p-4 hover:bg-[#1E2028] transition-all"
>
    <div class="flex items-center space-x-3.5">
        <i class="{{ $icon }} text-[#C0C4CE]"></i>
        <span class="text-[#C0C4CE] hover:text-gray-300">{{ $title }}</span>
    </div>
    <span class="text-[#3996DB] hover:text-[#C0C4CE]">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
        </svg>
    </span>
</a>
