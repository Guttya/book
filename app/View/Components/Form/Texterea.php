<?php

namespace App\View\Components\Form;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Texterea extends Component
{
    public ?string $id;
    public ?string $errorId;
    public string $name;
    public ?string $value;
    public ?string $label;
    public ?string $error;
    public ?string $placeholder;


    /**
     * Create a new component instance.
     *
     * @param string|null $id
     * @param string|null $errorId
     * @param string $name
     * @param string|null $value
     * @param string|null $label
     * @param string|null $error
     * @param string|null $placeholder
     */
    public function __construct(
        ?string $id = null,
        ?string $errorId = null,
        string $name,
        ?string $value = null,
        ?string $label = null,
        ?string $error = null,
        ?string $placeholder = null

    )
    {
        $this->id = $id;
        $this->errorId = $errorId;
        $this->name = $name;
        $this->value = $value;
        $this->label = $label;
        $this->error = $error;
        $this->placeholder = $placeholder;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.form.texterea');
    }
}
