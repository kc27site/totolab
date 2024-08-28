<?php

namespace App\Models;

use App\Enums\ScheduleType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'no',
        'type',
        'start_date',
        'end_date',
    ];

    public function games()
    {
        return $this->hasMany(Game::class, 'schedule_id');
    }

    public function getTypeJpAttribute()
    {
        return ScheduleType::getDescription($this->type);
    }
}
