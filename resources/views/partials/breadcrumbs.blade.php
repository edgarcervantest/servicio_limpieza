@unless ($breadcrumbs->isEmpty())
    <nav class="container mx-auto mb-5">
        <ol class="p-4 rounded flex flex-wrap text-base text-gray-50">
            @foreach ($breadcrumbs as $breadcrumb)

                @if ($breadcrumb->url && !$loop->last)
                    <li>
                        <a href="{{ $breadcrumb->url }}" class="text-[#9B2247] hover:text-[#611232] hover:underline focus:text-[#611232] focus:underline">
                            {{ $breadcrumb->title }}
                        </a>
                    </li>
                @else
                    <li>
                        {{ $breadcrumb->title }}
                    </li>
                @endif

                @unless($loop->last)
                    <li class="text-gray-500 px-2">
                        /
                    </li>
                @endif

            @endforeach
        </ol>
    </nav>
@endunless
