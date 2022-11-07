<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Category extends Model
{
    use HasFactory;
    use HasSlug;

    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    /**
     * @return MorphToMany
     */
    public function templates(): MorphToMany
    {
        return $this->morphedByMany(Template::class, 'categorizable');
    }

    /**
     * @return MorphToMany
     */
    public function brands(): MorphToMany
    {
        return $this->morphedByMany(Brand::class, 'categorizable');
    }
}
