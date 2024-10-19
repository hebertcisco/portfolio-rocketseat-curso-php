<?php

namespace App\Livewire\Components\Sections\HeroSection;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class LanguageBadges extends Component
{
    public User $user;

    public function mount(User $user): void
    {
        $this->user = $user;
    }
    public function render(): View|Factory|Application
    {
        return view('livewire.components.sections.hero-section.language-badges');
    }
}
