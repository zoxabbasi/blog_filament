<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\User;
use Livewire\Component;
use Illuminate\Http\Request;

class UpvoteDownvote extends Component
{
    public $post;
    // Creating a Post varable

    public function mount(Post $post )
    {
        $this->post = $post;
    }
    // This mount function will accept the post that has been passed in the compnent as a prop

    public function render()
    {
        $upvotes = \App\Models\UpvoteDownvote::where('post_id', '=', $this->post->id)
            ->where('is_upvote', '=', true)
            ->count();

        $downvotes = \App\Models\UpvoteDownvote::where('post_id', '=', $this->post->id)
            ->where('is_upvote', '=', false)
            ->count();


        $hasUpVote = null;

        $user = request()->user();

        if ($user) {
            $model =  \App\Models\UpvoteDownvote::where('post_id', '=', $this->post->id)
                ->where('user_id', '=', $user->id)
                ->first();
                if($model){
                    $hasUpVote = !!$model->is_upvote;
                }
        }
        // If the current user has upvoted a post or not
        return view('livewire.upvote-downvote', compact('upvotes', 'downvotes', 'hasUpVote'));
    }

    public function upvoteDownvote($upvote = true)
    {

        $user = request()->user();
        if (!$user) {
            return $this->redirect('login');
        }
        // If user doesn't exist redirect him to login page

        if (!$user->hasVerifiedEmail()) {
            return $this->redirect(route('verification.notice'));
        }

        $upvoteDownvote =  \App\Models\UpvoteDownvote::where('post_id', '=', $this->post->id)
            ->where('user_id', '=', $user->id)
            ->first();

        if (!$upvoteDownvote) {
            \App\Models\UpvoteDownvote::create([
                'is_upvote' => $upvote,
                'post_id' => $this->post->id,
                'user_id' => $user->id,
            ]);
            return;
        }

        if ($upvote && $upvoteDownvote->is_upvote || !$upvote && !$upvoteDownvote->is_updated) {
            $upvoteDownvote->delete();
        } else {
            $upvoteDownvote->is_upvote = $upvote;
            $upvoteDownvote->save();
        }
    }
}
