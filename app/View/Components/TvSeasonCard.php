<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TvSeasonCard extends Component
{

    public $season;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($season)
    {
        $this->season = $season;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tv-season-card');
    }
}
