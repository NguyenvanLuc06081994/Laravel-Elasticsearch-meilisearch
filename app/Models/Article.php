<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        ];
    }
}
