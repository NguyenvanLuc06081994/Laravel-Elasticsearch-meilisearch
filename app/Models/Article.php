<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;

class Article extends Model
{
    use HasFactory, Searchable;

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'teaser' => $this->teaser,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'published' => $this->published,
            'user_id' => $this->user_id,
        ];
    }

    public static function getSearchFilterAttributes(): array
    {
        return [
            'id',
            'title',
            'teaser',
            'created_at',
            'updated_at',
            'published',
            'user_id',
        ];
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
