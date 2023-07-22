<?php

namespace App\Filament\Widgets;


use App\Models\PostView;
use Filament\Widgets\Widget;
use App\Models\UpvoteDownvote;
use Illuminate\Database\Eloquent\Model;

class PostOvverview extends Widget
{
    protected static string $view = 'filament.widgets.post-ovverview';

    public ?Model $record = null;
    // As it is nullable, so adding a question mark is necessary

    protected function getViewData(): array
    {
        return [
            'viewCount' => PostView::where('post_id', '=', $this->record->id)->count(),

            'upvotes' => UpvoteDownvote::where('post_id', '=', $this->record->id)
                ->where('is_upvote', '=', 1)
                ->count(),
            'downvotes' =>  UpvoteDownvote::where('post_id', '=', $this->record->id)
            ->where('is_upvote', '=', 0)
            ->count(),
        ];
    }


    protected int | string | array $columnSpan = 3;
    // To extend the widget length
}
