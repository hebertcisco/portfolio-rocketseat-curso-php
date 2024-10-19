<?php

namespace App\Livewire\Components\Sections;

use App\Models\Projects;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ProjectsSection extends Component
{
    public Collection $projects;
    public User $user;

    public function mount(User $user): void
    {
        $this->user = $user;
        $this->projects = $this->getProjects();
    }

    public function render(): View|Factory|Application
    {
        return view('livewire.components.sections.projects-section');
    }

    #[Computed]
    public function getProjects(): Collection
    {
        return Projects::read();
    }
}
