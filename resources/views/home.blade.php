<?php
/** @var $posts \Illuminate\Pagination\LengthAwarePagination  */
?>

<x-app-layout>
    <!-- Posts Section -->
    <section class="w-full md:w-2/3 flex flex-col items-center px-3">

        @foreach ($posts as $post)
            {{-- <x-post-item> :post="$post" </x-post-item> --}}
            <article class="flex flex-col shadow my-4">
                <!-- Article Image -->
                <a href="{{ route('post.show', $post) }}" class="hover:opacity-75">
                    <img src="{{ $post->thumbnail }}">
                </a>
                <div class="bg-white flex flex-col justify-start p-6">
                    @foreach ($post->categories as $catagory)
                        <a href="{{ route('post.show', $post) }}"
                            class="text-blue-700 text-sm font-bold uppercase pb-4">{{ $catagory->title }}</a>
                    @endforeach
                    <a href="#" class="text-3xl font-bold hover:text-gray-700 pb-4">{{ $post->title }}</a>
                    <p href="#" class="text-sm pb-3">
                        By <a href="#" class="font-semibold hover:text-gray-800">{{ $post->user->name }}</a>,
                        Published on
                        {{ $post->getFormatedDate() }}
                    </p>
                    <a href="{{ route('post.show', $post) }}" class="pb-6">{!! $post->shortBody() !!}</a>
                    <a href="#" class="uppercase text-gray-800 hover:text-black">Continue Reading <i
                            class="fas fa-arrow-right"></i></a>
                </div>
            </article>
        @endforeach

        <!-- Pagination -->
        {{ $posts->onEachSide(1)->links() }}
    </section>
    <x-sidebar />
</x-app-layout>
