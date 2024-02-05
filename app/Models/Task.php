<?php

namespace App\Models;

use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    protected $appends = ['statusText'];

    protected $fillable = [
        'description',
        'user_id',
        'status'
    ];

    public function done()
    {
        $this->update([
            'status' => TaskStatus::DONE,
        ]);
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusTextAttribute(): ?string
    {

        return TaskStatus::statusText($this->status);
    }
}
