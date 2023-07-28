{{-- @props(['post']) --}}
<article class="flex flex-col my-4 shadow">
    <!-- Article Image -->
    <a href="#" class="hover:opacity-75">
        <img src="{{ $post->thumbnail }}">
    </a>
    <div class="flex flex-col justify-start p-6 bg-white">
        <a href="#" class="pb-4 text-3xl font-bold hover:text-gray-700">{{ $post->title }}</a>
        @if ($showAuthor)
            <p href="#" class="pb-3 text-sm">
                By <a href="#" class="font-semibold hover:text-gray-800">{{ $post->user->name }}</a>, Published on
                {{ $post->published_at }} | {{ $post->human_read_time }}
            </p>
        @endif
        <a href="{{ route('post.show', $post) }}" class="pb-6">{{ $post->shortBody() }}</a>
        <a href="{{ route('post.show', $post) }}" class="text-gray-800 uppercase hover:text-black">
            Continue Reading
            <i class="fas fa-arrow-right"></i>
        </a>
    </div>
</article>
