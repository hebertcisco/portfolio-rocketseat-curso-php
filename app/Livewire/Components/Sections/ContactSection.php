<?php

namespace App\Livewire\Components\Sections;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class ContactSection extends Component
{
    public function render(): View|Factory|Application
    {
        return view('livewire.components.sections.contact-section');
    }
}
