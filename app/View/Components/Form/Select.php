<?php

namespace App\View\Components\Form;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
{
    public ?string $id;
    public ?string $label;
    public ?string $errorId;
    public ?string $error;
    public string $name;
    public ?object $options;
    public ?object $attribut;

    /**
     * Create a new component instance.
     *
     * @param string|null $id
     * @param string|null $label
     * @param string|null $errorId
     * @param string|null $error
     * @param string $name
     * @param object|null $options
     * @param object|null $attribut
     */
    public function __construct(
        ?string $id = null,
        ?string $label = null,
        ?string $errorId = null,
        ?string $error = null,
        string  $name,
        object  $options = null,
        ?object $attribut = null
    )
    {
        $this->id = $id;
        $this->label = $label;
        $this->errorId = $errorId;
        $this->error = $error;
        $this->name = $name;
        $this->options = $options;
        $this->attribut = $attribut;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.form.select');
    }
}
