<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;


class Comments extends Component
{
    public $comments;

    public $post;
    // Creating a Post varable

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->comments = Comment::where('post_id', '=', $this->post->id)->orderByDesc('created_at')->get();
    }
    // This mount function will accept the post that has been passed in the compnent as a prop

    protected $listeners = [
        'commentCreated' => 'commentCreated'
    ];
    // Event Listener

    public function render()
    {
        return view('livewire.comments');
    }

    public function commentCreated(int $id){
        // dd('1234');
        // If our code reaches here it will dd 1234

        $comment = Comment::where('id', '=', $id)->first();
        $this->comments = $this->comments->prepend($comment);
    }
}
