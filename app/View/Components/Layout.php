<?php

namespace App\View\Components;

use App\Models\ProfilToko;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Layout extends Component
{
    /**
     * Create a new component instance.
     */
    public $konfigurasi;
    public function __construct()
    {
        $this->konfigurasi = ProfilToko::find(100);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layout');
    }
}
