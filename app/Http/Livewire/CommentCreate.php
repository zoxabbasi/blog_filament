<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;

class CommentCreate extends Component
{
    public string $comment = '';

    public $post;
    // Creating a Post varable

    public function mount(Post $post)
    {
        $this->post = $post;
    }
    // This mount function will accept the post that has been passed in the compnent as a prop

    public function render()
    {
        return view('livewire.comment-create');
    }

    public function createComment()
    {
        $user = auth()->user();
        if (!$user) {
            return redirect('/login');
        }
        $comment = Comment::create([
            'comment' => $this->comment,
            'post_id' => $this->post->id,
            'user_id' => $user->id,
        ]);

        $this->emitUp('commentCreated', $comment->id);
        // This will tell the parent to autoload the comment that was
        $this->comment = '';
        // To clear the textarea from the previous comment
    }
}
