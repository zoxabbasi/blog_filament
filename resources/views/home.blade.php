<?php
/** @var $posts \Illuminate\Pagination\LengthAwarePagination  */
?>

<x-app-layout>
    <div class="grid grid-cols-1 gap-8 md:grid-cols-3">

        <div class="col-span-2">
            <h2 class="pb-1 mb-3 text-lg font-bold text-blue-500 uppercase border-b-2 border-blue-500 sm:text-xl">
                Latest Post
            </h2>
            <x-post-item :post="$latestPost" />
        </div>
        <div>
            <h2 class="pb-1 mb-3 text-lg font-bold text-blue-500 uppercase border-b-2 border-blue-500 sm:text-xl">
                Popular Posts
            </h2>
            @foreach ($popularPost as $post)
                <div class="grid grid-cols-4 gap-2 mb-4">
                    <a href="{{ route('post.show', $post) }}" class="pt-1">
                        <img src="/storage/{{ $post->thumbnail }}" alt="{{ $post->title }}">
                    </a>
                    <div class="col-span-3">
                        <a href="{{ route('post.show', $post) }}">
                            <h3 class="text-sm uppercase truncate">{{ $post->title }}</h3>
                        </a>
                        <div class="flex gap-4 mb-2">
                            @foreach ($post->categories as $catagory)
                                <a href="#"
                                    class="p-1 text-xs font-bold text-white uppercase bg-blue-500 rounded">
                                    {{ $catagory->title }}
                                </a>
                            @endforeach
                        </div>
                        <div class="text-xs">{{ $post->shortBody(15) }}</div>
                        <a href="{{ route('post.show', $post) }}"
                            class="text-xs text-gray-800 uppercase hover:text-black">
                            Continue Reading
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div>
        <h2 class="pb-1 mb-3 text-lg font-bold text-blue-500 uppercase border-b-2 border-blue-500 sm:text-xl">
            Recomended Posts
        </h2>
        <div class="grid grid-cols-1 gap-3 md:grid-cols-3">
            @foreach ($recommendedPosts as $post)
                <x-post-item :post="$post" :show-author="false"/>
            @endforeach
        </div>
    </div>

    <div>
        <h2 class="pb-1 mb-3 text-lg font-bold text-blue-500 uppercase border-b-2 border-blue-500 sm:text-xl">
            Recent Catagories
        </h2>
    </div>
    {{-- To display 10 posts --}}
    <!-- Posts Section -->
    {{-- <section class="flex flex-col items-center w-full px-3 md:w-2/3"> --}}

    {{-- @foreach ($posts as $post) --}}
    {{-- <x-post-item> :post="$post" </x-post-item> --}}
    {{-- <article class="flex flex-col my-4 shadow"> --}}
    <!-- Article Image -->
    {{-- <a href="{{ route('post.show', $post) }}" class="hover:opacity-75">
                    <img src="/storage/{{ $post->thumbnail }}">
                </a>
                <div class="flex flex-col justify-start p-6 bg-white">
                    <div class="flex gap-4">
                        @foreach ($post->categories as $catagory)
                            <a href="{{ route('post.show', $post) }}"
                                class="pb-4 text-sm font-bold text-blue-700 uppercase">{{ $catagory->title }}</a>
                        @endforeach
                    </div>
                    <a href="#" class="pb-4 text-3xl font-bold hover:text-gray-700">{{ $post->title }}</a>
                    <p href="#" class="pb-3 text-sm">
                        By <a href="#" class="font-semibold hover:text-gray-800">{{ $post->user->name }}</a>,
                        Published on
                        {{ $post->getFormatedDate() }}
                    </p>
                    <a href="{{ route('post.show', $post) }}" class="pb-6">{!! $post->shortBody() !!}</a>
                    <a href="#" class="text-gray-800 uppercase hover:text-black">Continue Reading <i
                            class="fas fa-arrow-right"></i></a>
                </div>
            </article>
        @endforeach --}}

    {{-- Pagination --}}
    {{-- {{ $posts->onEachSide(1)->links() }}
    </section>
    <x-sidebar /> --}}
</x-app-layout>
