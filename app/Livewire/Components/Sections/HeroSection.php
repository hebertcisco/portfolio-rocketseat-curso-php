<?php

namespace App\Livewire\Components\Sections;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Str;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class HeroSection extends Component
{
    #[Locked]
    public User $user;

    public string $magic_word = 'Hello World!';

    public string $title = "Full Stack Developer";

    public string $phrase = '';

    public function mount(User $user): void
    {
        $this->user = $user;
        $this->title  = Str::of($user->bio)
            ->explode('|')
            ->first();

        $this->generateMagicWords();
        $this->phrase = $this->generatePhrase();
    }

    public function render(): View|Factory|Application
    {
        return view('livewire.components.sections.hero-section');
    }

    #[On('magic-word-pool-refresh')]
    public function generateMagicWords(): void
    {
        $magic_words = getMagicWords();
        $this->magic_word = $magic_words[array_rand($magic_words)];
        $this->user = getUser();
    }

    public function generatePhrase(): string
    {
        $phrases = [
            'Sou ' .changeGender('um') . ' ' . changeGender('desenvolvedor') . ' ' . changeGender('apaixonado') . ' por tecnologia.',
            changeGender('Desenvolvedor') . ' ' . changeGender('apaixonado') . ' por tecnologia.',
            'Minha paixão é desenvolver soluções inovadoras',
        ];

        return $phrases[array_rand($phrases)];
    }
}
