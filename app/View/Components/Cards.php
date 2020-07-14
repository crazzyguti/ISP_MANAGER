<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Cards extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type, $message)
    {

        $this->color = "";
        $this->type = $type;
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.cards');
    }
}
