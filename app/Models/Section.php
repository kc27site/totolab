<?php

namespace App\Models;

// use App\Enums\SectionType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'blog_id', 
        'schedule_id', 
        'game_id', 
        'type', 
        'position', 
        'content', 
        'image_url'
    ];

    /**
     * Section belongs to a Blog.
     */
    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    /**
     * Section belongs to a Schedule.
     * Assuming `Schedule` model exists.
     */
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    /**
     * Section belongs to a Game.
     * Assuming `Game` model exists.
     */
    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
