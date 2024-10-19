<?php

namespace App\Livewire\Components\Sections\ContactSection;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class SocialLink extends Component
{
    public string $icon;
    public string $link;
    public string $title;

    public function mount($icon, $link, $title): void
    {
        $this->icon = $icon;
        $this->link = $link;
        $this->title = $title;
    }

    public function render(): View|Factory|Application
    {
        return view('livewire.components.sections.contact-section.social-link');
    }
}
