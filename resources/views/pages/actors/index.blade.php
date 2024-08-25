@extends('layouts.app')
@section('content')
    <section class="container mx-auto px-4 py-16">
        <div class="poplular-actors">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Popular Actors</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($popularActors as $actor)
                    <div class="actor mt-8">
                        <a href="{{ route('actor.one', $actor['id']) }}">
                            <img src="{{ $actor['profile_path'] }}" alt="profile"
                                class="hover:opacity-75 rounded-xl transition ease-in-out duration-150">
                        </a>
                        <div class="mt-2">
                            <a href="{{ route('actor.one', $actor['id']) }}"
                                class="text-lg mt-2 hover:text-gray-300">{{ $actor['name'] }}</a>
                            <div class="text-gray-400 text-sm truncate">{{ $actor['known_for'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div><!-- end poplular-actor -->

        <div class="page-load-status my-8">
            <div class="flex justify-center">
                <div class="infinite-scroll-request spinner my-8 text-4xl">&nbsp;</div>
            </div>
            <p class="infinite-scroll-last">End of content</p>
            <p class="infinite-scroll-error">No more pages to load</p>
        </div>

        {{-- <div class="flex justify-between mt-16">
            @if ($back)
                <a href="/actor/page/{{ $back }}">Back</a>
            @else
                <div></div>
            @endif

            @if ($next)
                <a href="/actor/page/{{ $next }}">Next</a>
            @else
                <div></div>
            @endif
        </div> --}}
    </section>
@endsection
@push('scripts')
    <script src="https://unpkg.com/infinite-scroll@4/dist/infinite-scroll.pkgd.min.js"></script>
    <script>
        let elem = document.querySelector('.grid');
        let infScroll = new InfiniteScroll(elem, {
            // options
            path: '/actor/page/@{{#}}',
            append: '.actor',
            status: '.page-load-status'
            // history: false,
        });
    </script>
@endpush
