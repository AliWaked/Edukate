<?php

namespace App\View\Components\Dashboard\Partials;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\View\Component;

class links extends Component
{
    public array $links = [];
    /**
     * Create a new component instance.
     */
    public function __construct(public string $type)
    {
        if ($type == 'dashboard') {
        // dd('hi');
            // $type.= Auth::guard()->name;
            $type .= '.'. Config::get('fortify.guard');
        }
        $this->links = config("links.$type");
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.partials.links', ['links' => $this->links]);
    }
}
