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

    public ?Comment $commentModel = null;

    public function mount(Post $post, $commentModel = null)
    {
        $this->post = $post;
        $this->commentModel = $commentModel;
        $this->comment = $commentModel ?  $commentModel->comment : '';
        // dd($commentModel);
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
        if ($this->commentModel) {
            if ($this->commentModel->user_id != $user->id) {
                return response('You are not allowed to perform this action', 403);
            }
            $this->commentModel->comment = $this->comment;
            $this->commentModel->save();
            $this->comment = '';
            $this->emitUp('commentUpdated');
        } else {
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
            // This will tell the parent to autoload the comment that was created
            $this->comment = '';
            // To clear the textarea from the previous comment
        }
        //    If commentModel exists then we are in edit mode, orelse we are in create mode
    }
}
