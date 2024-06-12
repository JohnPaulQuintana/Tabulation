<h1 class="mb-2 py-4">Categories:</h1>
<ol class="flex justify-center py-4 items-center w-full">
    @php
        $activeClass = 'bg-red-500';
        $inactiveClass = 'bg-slate-300';
        $foundActive = false;
    @endphp
    @foreach ($categories as $key => $category)
        @if ($category->status == 1)
            @php
                $foundActive = true;
            @endphp
        @endif

        <li class="relative w-full mb-6">
            <div class="flex items-center">
                <div class="z-10 flex items-center justify-center w-6 h-6 {{ !$foundActive || $category->status == 1 ? $activeClass : $inactiveClass }} rounded-full ring-transparent sm:ring-8 shrink-0">
                    <svg class="w-2.5 h-2.5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                    </svg>
                </div>
                @if (count($categories) !== $key + 1)
                    <div class="flex w-full {{ !$foundActive || $category->status == 1 ? $activeClass : $inactiveClass }} h-0.5"></div>
                @endif
            </div>
            <div class="mt-3">
                <h3 class="font-medium text-slate-500">{{ $category->category_name }}</h3>
            </div>
        </li>

        @if ($foundActive)
            @php
                $activeClass = 'bg-slate-300';
            @endphp
        @endif
    @endforeach
</ol>
