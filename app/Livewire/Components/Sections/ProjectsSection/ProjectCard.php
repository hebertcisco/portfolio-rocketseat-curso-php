<?php

namespace App\Livewire\Components\Sections\ProjectsSection;

use App\Models\Projects;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class ProjectCard extends Component
{
    public Projects $project;

    public function mount(Projects $project): void
    {
        $this->project = $project;
    }

    public function render(): View|Factory|Application
    {
        return view('livewire.components.sections.projects-section.project-card');
    }
}
