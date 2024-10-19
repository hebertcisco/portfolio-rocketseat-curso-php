<?php

namespace App\Models;

use App\Requests\GithubRequest;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;

/**
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $login
 * @property int $id
 * @property string $node_id
 * @property string $avatar_url
 * @property string $gravatar_id
 * @property string $url
 * @property string $html_url
 * @property string $followers_url
 * @property string $following_url
 * @property string $gists_url
 * @property string $starred_url
 * @property string $subscriptions_url
 * @property string $organizations_url
 * @property string $repos_url
 * @property string $events_url
 * @property string $received_events_url
 * @property string $type
 * @property bool $site_admin
 * @property string $company
 * @property string $blog
 *
 * @property string $location
 * @property string $hireable
 * @property string $bio
 * @property string $twitter_username
 * @property int $public_repos
 * @property int $public_gists
 * @property int $followers
 *
 * @property int $following
 * @property string $created_at
 * @property string $updated_at
 */
class User extends Authenticatable
{
    const CACHE_MINUTES = 10;
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'login',
        'id',
        'node_id',
        'avatar_url',
        'gravatar_id',
        'url',
        'html_url',
        'followers_url',
        'following_url',
        'gists_url',
        'starred_url',
        'subscriptions_url',
        'organizations_url',
        'repos_url',
        'events_url',
        'received_events_url',
        'type',
        'site_admin',
        'company',
        'blog',
        'location',
        'hireable',
        'bio',
        'twitter_username',
        'public_repos',
        'public_gists',
        'followers',
        'following',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public static function make(): User
    {
        return new User();
    }

    public function getUser(): User
    {
        return Cache::remember($this->userCacheKey(), now()->addMinutes(self::CACHE_MINUTES), function () {
            $user = $this->getGithubProfile();
            return new User($user);
        });
    }

    /**
     * @throws ConnectionException
     */
    public function getGithubLanguages(): array
    {
        $result = (array) GithubRequest::make()
            ->get_most_used_languages(config('services.github.username', env('GITHUB_USERNAME')));

        return Cache::remember($this->userCacheKey() . '_languages', now()->addMinutes(self::CACHE_MINUTES), function () use ($result) {
            if (empty($result)) {
                return [];
            }
            return $result;
        });
    }

    /**
     * @throws ConnectionException
     */
    public function getGithubProfile(): array
    {
        $result = (array) GithubRequest::make()
            ->get_github_profile(config('services.github.username', env('GITHUB_USERNAME')));

        return Cache::remember($this->userCacheKey(), now()->addMinutes(self::CACHE_MINUTES), function () use ($result) {
            if (empty($result)) {
                return [];
            }
            return $result;
        });
    }

    private function userCacheKey(): string
    {
        return 'user_' . config('services.github.username', env('GITHUB_USERNAME'));
    }
}
