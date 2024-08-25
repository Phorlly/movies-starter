@extends('layouts.app')
@section('content')
    <section class="tv-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
            <img src="{{ $tv['poster_path'] }}" alt="poster"
                class="hover:opacity-75 rounded-xl transition ease-in duration-150 w-64 lg:w-96">
            <div class="md:ml-24">
                <h2 class="text-4xl font-semibold">{{ $tv['name'] }}</h2>
                <div class="flex flex-wrap items-center text-gray-400 text-sm mt-3">
                    <sv class="fill-current text-orange-500 w-4" viewBox="0 0 24 24">
                        <g data-name="Layer 2">
                            <path
                                d="M17.56 21a1 1 0 01-.46-.11L12 18.22l-5.1 2.67a1 1 0 01-1.45-1.06l1-5.63-4.12-4a1 1 0 01-.25-1 1 1 0 01.81-.68l5.7-.83 2.51-5.13a1 1 0 011.8 0l2.54 5.12 5.7.83a1 1 0 01.81.68 1 1 0 01-.25 1l-4.12 4 1 5.63a1 1 0 01-.4 1 1 1 0 01-.62.18z"
                                data-name="star" />
                        </g>
                    </sv>
                    <span class="ml-1">{{ $tv['vote_average'] }}</span>
                    <span class="mx-2">|</span>
                    <span>{{ $tv['first_air_date'] }}</span>
                    <span class="mx-2">|</span>
                    <span>{{ $tv['genres'] }}</span>
                </div>

                <p class="text-gray-300 mt-8">
                    {{ $tv['overview'] }}
                </p>

                <div class="mt-12">
                    <div class="flex mt-4">
                        @foreach ($tv['created_by'] as $crew)
                            <div class="mr-8">
                                <div>{{ $crew['name'] }}</div>
                                <div class="text-sm text-gray-400">Creator</div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div x-data="{ isOpen: false }">
                    @if (count($tv['videos']['results']) > 0)
                        <div class="mt-12">
                            <button @click="isOpen = true"
                                href="https://youtube.com/watch?v={{ $tv['videos']['results'][0]['key'] }}"
                                class="flex md:inline-flex items-center bg-orange-500 text-gray-900 rounded-xl font-semibold px-5 py-4 hover:bg-orange-600 transition ease-in-out duration-150">
                                <svg class="w-6 fill-current" viewBox="0 0 24 24">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" />
                                </svg>
                                <span class="ml-2">Play Trailer</span>
                            </button>
                        </div>

                        {{-- modal frame for play video --}}
                        <template x-if="isOpen">
                            <div style="background-color: rgba(0, 0, 0, .5);"
                                class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto">
                                <div class="container mx-auto lg:px-32 overflow-y-auto">
                                    <div class="bg-gray-900 rounded-xl">
                                        <div class="flex justify-end pr-4 pt-2">
                                            <button @click="isOpen = false" @keydown.escape.window="isOpen = false"
                                                class="text-3xl leading-none hover:text-gray-300">&times;
                                            </button>
                                        </div>
                                        <div class="modal-body p-6">
                                            <div class="responsive-container overflow-hidden relative"
                                                style="padding-top: 56.25%">
                                                <iframe
                                                    class="rounded-lg responsive-iframe absolute top-0 left-0 w-full h-full"
                                                    src="https://www.youtube.com/embed/{{ $tv['videos']['results'][0]['key'] }}"
                                                    style="border:0;" allow="autoplay; encrypted-media" allowfullscreen>
                                                </iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    @endif

                </div>

            </div>
        </div>
    </section>

    <section class="tv-cast border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold uppercase">Cast</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($tv['cast'] as $cast)
                    <div class="mt-8">
                        <a href="{{ route('actor.one', $cast['id']) }}">
                            <img src="{{ $cast['profile_path'] }}" alt="cast"
                                class="hover:opacity-75 rounded-xl transition ease-in duration-150">
                        </a>
                        <div class="mt-2">
                            <a href="{{ route('actor.one', $cast['id']) }}"
                                class="text-lg mt-2 hover:text-gray-300">{{ $cast['name'] }}</a>
                            <div class="flex items-center text-gray-400 text-sm mt-1">
                                {{ $cast['character'] }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <section class="tv-image" x-data="{ isOpen: false, image: '' }">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold uppercase">Images</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($tv['images'] as $image)
                    <div class="mt-8">
                        <button
                            @click.prevent="isOpen = true, image='{{ 'https://image.tmdb.org/t/p/original/' . $image['file_path'] }}' ">
                            <img src="{{ 'https://image.tmdb.org/t/p/w300/' . $image['file_path'] }}" alt="image"
                                class="hover:opacity-75 rounded-xl transition ease-in duration-150">
                        </button>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- modal frame for preview image --}}
        <div x-show.transition.opacity="isOpen" style="background-color: rgba(0, 0, 0, .5);"
            class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto">
            <div class="container mx-auto lg:px-32 overflow-y-auto">
                <div class="bg-gray-900 rounded-xl">
                    <div class="flex justify-end pr-4 pt-2">
                        <button @click="isOpen = false" @keydown.escape.window="isOpen = false"
                            class="text-3xl leading-none hover:text-gray-300">&times;
                        </button>
                    </div>
                    <div class="modal-body p-6">
                        <img :src="image" class="rounded-lg" alt="poster">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
