<?php

namespace App\View\Components\Form;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputText extends Component
{
    public ?string $id;
    public ?string $errorId;
    public string $name;
    public ?string $value;
    public ?string $placeholder;
    public ?string $label;
    public ?string $error;
    public string $type;

    /**
     * Create a new component instance.
     *
     * @param string|null $id
     * @param string|null $errorId
     * @param string $name
     * @param string|null $value
     * @param string|null $placeholder
     * @param string|null $label
     * @param string|null $error
     * @param string $type
     */
    public function __construct(
        ?string $id = null,
        ?string $errorId = null,
        string $name,
        ?string $value = null,
        ?string $placeholder = null,
        ?string $label = null,
        ?string $error = null,
        string $type
    )
    {
        $this->id = $id;
        $this->errorId = $errorId;
        $this->name = $name;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->label = $label;
        $this->error = $error;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.form.input-text');
    }
}
