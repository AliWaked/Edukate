<?php

namespace App\View\Components\front\partials;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Links extends Component
{
    public array $links = [];
    /**
     * Create a new component instance.
     */
    public function __construct(public string $type)
    {
        $this->links = config("links.$type");
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.front.partials.links',['links'=>$this->links]);
    }
}
