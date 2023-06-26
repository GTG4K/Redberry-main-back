<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Quote extends Model
{
    use HasFactory, HasTranslations;

    protected $guarded = [
        'id',
    ];

    public array $translatable = ['quote'];

    public function getImageAttribute($value)
    {
        return asset('storage/' . $value);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function likedByAuthUser()
    {
        $likes = Like::where('quote_id', $this->id)->get();
        foreach ($likes as $like) {
            if ($like->user_id == auth()->user()->id) {
                return true;
            }
        }
        return false;
    }
}
