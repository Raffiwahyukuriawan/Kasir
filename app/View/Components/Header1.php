<?php

namespace App\View\Components;

use App\Models\ProfilToko;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Header1 extends Component
{
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
        return view('components.header1');
    }
}
