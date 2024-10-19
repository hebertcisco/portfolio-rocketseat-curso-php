<?php

namespace App\Requests;


use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class GithubRequest
{
    const GITHUB_API_URL = 'https://api.github.com';

    public static function make(): GithubRequest
    {
        return new self();
    }

    /**
     * @throws ConnectionException
     */
    public function get_github_profile($username)
    {
        $url = self::GITHUB_API_URL . "/users/$username";

        $response = Http::withHeaders([
            'X-GitHub-Api-Version' => '2022-11-28',
            'Authorization' => 'Bearer ' . config('github.token', env('GITHUB_TOKEN'))
        ])->get($url);

        if ($response->status() !== 200) {
            return null;
        }

        return $response->json();
    }

    /**
     * @throws ConnectionException
     */
    public function get_most_used_languages($username): array
    {
        $url = self::GITHUB_API_URL . "/users/$username/repos";

        $response = Http::withHeaders([
            'X-GitHub-Api-Version' => '2022-11-28',
            'Authorization' => 'Bearer ' . config('github.token', env('GITHUB_TOKEN'))
        ])->get($url);

        if ($response->status() !== 200) {
            return [];
        }

        $repos = $response->json();
        if (empty($repos)) {
            return [];
        }
        $languages = [];
        foreach ($repos as $repo) {
            if (empty($repo['languages_url'])) {
                continue;
            }
            $languages_url = $repo['languages_url'];

            $languages_response = Http::withHeaders([
                'X-GitHub-Api-Version' => '2022-11-28',
                'Authorization' => 'Bearer ' . config('github.token', env('GITHUB_TOKEN'))
            ])->get($languages_url);

            if ($languages_response->status() !== 200) {
                continue;
            }

            $languages = array_merge($languages, array_keys($languages_response->json()));
        }

        $bad_keys = ['Shell', 'Dockerfile', 'Vim Script', 'Makefile'];

        $result = array_diff($languages, $bad_keys);
        $result = array_unique($result);
        $result = array_filter($result);
        return array_slice($result, 0, 5);
    }
}
