<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Component;

#[Layout('layouts.app', ['title' => ' FullStack Software Developer | Home'])]
class HomePage extends Component
{
    public function render(): View|Factory|Application
    {
        return view('livewire.home-page');
    }

    #[Computed]
    public function getUser(): User
    {
        return getUser();
    }
}
