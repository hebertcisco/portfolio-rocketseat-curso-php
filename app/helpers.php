<?php

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

if (!function_exists('changeGender')) {
    /**
     * Altera o gênero da palavra passada de forma automática.
     *
     * @param string $word  A palavra que será alterada.
     * @param string|null $genre  O gênero a ser aplicado (masculino/feminino).
     * @return string  A palavra com o gênero alterado.
     */
    function changeGender(string $word = '', ?string $genre = null): string
    {
        $genre = strtolower($genre) ?? env('GENRE', 'male');
        $word_lower = strtolower($word);

        if ($genre === 'female') {
            if (Str::endsWith($word_lower, 'o')) {
                return Str::replaceLast('o', 'a', $word_lower);
            } elseif (Str::endsWith($word_lower, 'or')) {
                return Str::replaceLast('or', 'ora', $word_lower);
            } elseif (Str::endsWith($word_lower, 'um')) {
                return Str::replaceLast('um', 'uma', $word_lower);
            }
        }

        if ($genre === 'male') {
            if (Str::endsWith($word_lower, 'a')) {
                return Str::replaceLast('a', 'o', $word_lower);
            } elseif (Str::endsWith($word_lower, 'ora')) {
                return Str::replaceLast('ora', 'or', $word_lower);
            }
        }

        return $word;
    }
}

if (!function_exists('getMagicWords')) {
    /**
     * Retorna uma lista de palavras mágicas embaralhadas.
     *
     *  @return array  Lista de palavras mágicas.
     */
    function getMagicWords(): array
    {
        $magic_words = [
            'Hello World!',
            'puts "Hello, World!"',
            'System.out.println("Hello, World!");',
            'print("Hello, World!")',
            'echo "Hello, World!";',
            'console.log("Hello, World!");',
            'alert("Hello, World!");',
            'document.write("Hello, World!");',
            'printf("Hello, World!");',
            'cout << "Hello, World!";',
            'printf("Hello, World!");',
            'print("Hello, World!")',
            'Console.WriteLine("Hello, World!");',
        ];

        return Arr::shuffle($magic_words);
    }
}

if (!function_exists('getAvatar')) {
    /**
     * Retorna a URL da imagem do avatar do usuário.
     *  @param User $user  O usuário que terá o avatar retornado.
     */
    function getAvatar(User $user): string
    {
        $cached = Cache::remember('avatar_' . $user->id, now()->addMinutes(User::CACHE_MINUTES), function () use ($user) {
            $avatar_url = $user->avatar_url;
            $avatar_url_is_valid = filter_var($avatar_url, FILTER_VALIDATE_URL);
            $avatar_url_is_valid = $avatar_url_is_valid && @getimagesize($avatar_url);
            return $avatar_url_is_valid ? $avatar_url : "https://github.com/$user->login.png";
        });

        if (Str::startsWith($cached, 'http')) {
            return $cached;
        }
        return 'data:image/png;base64,' . $cached;
    }
}

if (!function_exists('getGithubColors')) {
    /**
     * Retorna a lista de cores dos repositórios do GitHub.
     *
     *  @return array  Lista de cores dos repositórios do GitHub.
     */
    function getGithubColors(): array
    {
        return Cache::remember('github_colors', now()->addMinutes(User::CACHE_MINUTES), function () {
            $response = Http::get('https://raw.githubusercontent.com/ozh/github-colors/refs/heads/master/colors.json')
                ->json();

            $reactNative = ['color' => '#61DAFB'];
            $react = ['color' => '#61DAFB'];
            $laravel = ['color' => '#FF2D20'];
            $nodejs = ['color' => '#43853D'];

            foreach ($response as $key => $value) {
                if ($key == 'react-native') {
                    $response[$key] = $reactNative;
                }
                if ($key == 'react') {
                    $response[$key] = $react;
                }
                if ($key == 'laravel') {
                    $response[$key] = $laravel;
                }
                if ($key == 'nodejs') {
                    $response[$key] = $nodejs;
                }
            }

            $result = collect($response);

            $result = $result->mapWithKeys(function ($item, $key) {
                $key = strtolower($key);
                return [$key => $item];
            });





            return $result->toArray();
        });
    }
}

if (!function_exists('getLanguageColor')) {
    /**
     * Retorna a cor da linguagem de programação.
     *
     *  @param string $language  A linguagem de programação.
     *  @return string  A cor da linguagem de programação.
     */
    function getLanguageColor(string $language): string
    {
        $language = strtolower($language);

        $colors = getGithubColors();

        $color = $colors[$language]['color'] ?? '#2B2B2B';
        $color = Str::replaceFirst('#', '', $color);

        return (string) Cache::remember('language_color_' . $language, now()->addMinutes(User::CACHE_MINUTES), function () use ($color) {
            return $color;
        });
    }
}

if (!function_exists('getUser')) {
    /**
     * Retorna os dados do usuário.
     * @return User  Os dados do usuário.
     */
    function getUser(): User
    {
        return Cache::remember('user', User::CACHE_MINUTES, function () {
            return User::make()->getUser();
        });
    }
}
