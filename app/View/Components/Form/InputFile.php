<?php

namespace App\View\Components\Form;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputFile extends Component
{
    public ?string $class;
    public ?string $id;
    public ?string $errorId;
    public string $name;
    public ?string $label;
    public ?string $label2;
    public ?string $error;
    public string $type;


    /**
     * Create a new component instance.
     *
     * @param string|null $class
     * @param string|null $id
     * @param string|null $errorId
     * @param string $name
     * @param string|null $label
     * @param string|null $label2
     * @param string|null $error
     * @param string $type
     */
    public function __construct(
        ?string $class = null,
        ?string $id = null,
        ?string $errorId = null,
        string $name,
        ?string $label = null,
        ?string $label2 = null,
        ?string $error = null,
        string $type
    )
    {
        $this->class = $class;
        $this->id = $id;
        $this->errorId = $errorId;
        $this->name = $name;
        $this->label = $label;
        $this->label2 = $label2;
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
        return view('components.form.input-file');
    }
}
