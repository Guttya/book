<?php

namespace App\View\Components\Form;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select2 extends Component
{
    public ?string $id;
    public ?string $label;
    public ?string $errorId;
    public string $name;
    public ?array $options;
    public ?object $value;
    public $selected;
    public bool $isMultiply;
    public string $placeholder;

    /**
     * Create a new component instance.
     * @param string|null $id
     * @param string|null $label
     * @param string|null $errorId
     * @param string $name
     * @param array $options
     * @param object|null $value
     * @param null $selected
     * @param bool $isMultiply
     * @param string $placeholder
     */
    public function __construct(
        string $id = null,
        string $label = null,
        string $errorId = null,
        string $name,
        array $options,
        object $value = null,
        $selected = null,
        bool $isMultiply = true,
        string $placeholder
    )
    {
        $this->id = $id;
        $this->label = $label;
        $this->errorId = $errorId;
        $this->name = $name;
        $this->options = $options;
        $this->value = $value;
        $this->selected = $selected;
        $this->isMultiply = $isMultiply;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.form.select2');
    }

    public function isSelected($option): bool
    {
        if ($this->selected) {
            $isSelected = is_array($this->selected) ? in_array($option, $this->selected) : $option === $this->selected;
        }

        return $isSelected ?? false;
    }
}
