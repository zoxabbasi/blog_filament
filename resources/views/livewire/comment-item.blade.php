<div>
    <div class="flex gap-3 mb-4">
        <div class="flex items-center justify-center w-12 h-12 bg-gray-200 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
            </svg>
        </div>
        <div>
            <div>
                <a href="" class="font-semibold text-blue-600">{{ $comment->user->name }}</a>
                - <span class="text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
            </div>
            @if ($editing)
                @livewire('comment-create', ['commentModel' => $comment])
            @else
                <div class="text-gray-700 ">
                    {{ $comment->comment }}
                </div>
            @endif
            <div>
                <a href="#" class="mr-3 text-sm text-blue-600">Reply</a>
                @if (Auth::id() == $comment->user_id)
                    <a wire:click.prevent="editComment" href="#" class="mr-3 text-sm text-green-600">Edit</a>
                    <a wire:click.prevent="deleteComment" href="#" class="mr-3 text-sm text-red-600">Delete</a>
                @endif
            </div>
        </div>

    </div>
    {{-- $comment is comment model and the other is actual comment --}}
</div>
