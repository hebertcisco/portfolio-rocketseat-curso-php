<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property string $description
 * @property string $image
 * @property string $link
 * @property array $tags
 * @property string $date
 * @property string $created_at
 * @property string $updated_at
 */
class Projects extends Model
{
    /** @use HasFactory<UserFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'image',
        'link',
        'tags',
        'date',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tags' => 'array',
        ];
    }

    public static function make(): Projects
    {
        return new Projects();
    }

    public static function read(): \Illuminate\Support\Collection
    {
        $projects = json_decode(file_get_contents(database_path('projects.json')), true);
        $projects = collect($projects)->sortByDesc('date')->toArray();
        return collect($projects)->map(function ($project) {
            $tags = collect($project['tags'])->map(function ($tag) {
                return $tag;
            });
            $tags = $tags->take(3);
            $project['tags'] = $tags;

            return (new Projects())->fill($project);
        });
    }
}
