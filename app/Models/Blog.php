<?php

namespace App\Models;

use App\Enums\BlogType;
use App\Enums\BlogStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'no',
        'schedule_no', 
        'type', 
        'status', 
        'title', 
        'released_at'
    ];

    public function sections()
    {
        return $this->hasMany(Section::class)->orderBy('position');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'no', 'schedule_no');
    }

    public function getTypeJpAttribute()
    {
        return BlogType::getDescription($this->type);
    }

    public function getStatusJpAttribute()
    {
        return BlogStatus::getDescription($this->status);
    }
}
