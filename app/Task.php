<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'frequency',
        'start_date',
        'end_date',
        'iterations',
        'task_group_id',
        'user_id',
        'completed'
    ];

    public function taskGroup()
    {
        return $this->belongsTo(TaskGroup::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePending($query)
    {
        return $query->whereNull('completed_at')->orderBy('start_date');
    }

    public function scopeCompleted($query)
    {
        return $query->whereNotNull('completed_at')->orderBy('completed_at', 'desc');
    }

    public function isCompleted()
    {
        return !is_null($this->completed_at);
    }

    public function complete()
    {
        $this->completed_at = now();
        $this->save();
    }

    public function uncomplete()
    {
        $this->completed_at = null;
        $this->save();
    }
}
