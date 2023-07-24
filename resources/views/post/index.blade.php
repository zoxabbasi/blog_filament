<?php
/** @var $posts \Illuminate\Pagination\LengthAwarePagination  */
?>

<x-app-layout>
    <!-- Posts Section -->
    <section class="flex flex-col items-center w-full px-3 md:w-2/3">

        @foreach ($posts as $post)
            {{-- <x-post-item> :post="$post" </x-post-item> --}}
            <article class="flex flex-col my-4 shadow">
                <!-- Article Image -->
                <a href="{{ route('post.show', $post) }}" class="hover:opacity-75">
                    <img src="/storage/{{ $post->thumbnail }}">
                </a>
                <div class="flex flex-col justify-start p-6 bg-white">
                    @foreach ($post->categories as $catagory)
                        <a href="{{ route('post.show', $post) }}"
                            class="pb-4 text-sm font-bold text-blue-700 uppercase">{{ $catagory->title }}</a>
                    @endforeach
                    <a href="#" class="pb-4 text-3xl font-bold hover:text-gray-700">{{ $post->title }}</a>
                    <p href="#" class="pb-3 text-sm">
                        By <a href="#" class="font-semibold hover:text-gray-800">{{ $post->user->name }}</a>,
                        Published on
                        {{ $post->getFormatedDate() }} | {{ $post->humanReadTime }}
                    </p>
                    <a href="{{ route('post.show', $post) }}" class="pb-6">{!! $post->shortBody() !!}</a>
                    <a href="#" class="text-gray-800 uppercase hover:text-black">Continue Reading <i
                            class="fas fa-arrow-right"></i></a>
                </div>
            </article>
        @endforeach

        <!-- Pagination -->
        {{ $posts->onEachSide(1)->links() }}
    </section>
    <x-sidebar />
</x-app-layout>
