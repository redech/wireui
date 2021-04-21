<?php

namespace WireUi\View\Components\Inputs;

use Exception;
use Illuminate\Support\Str;
use WireUi\View\Components\Input;

abstract class BaseMaskable extends Input
{
    protected const VIEW = 'wireui::components.inputs.maskable';

    public bool $emitFormatted;

    public string $mask;

    public function __construct(
        bool $emitFormatted = false,
        ?string $mask = null,
        ?string $color = null,
        ?string $label = null,
        ?string $hint = null,
        ?string $cornerHint = null,
        ?string $icon = null,
        ?string $rightIcon = null,
        ?string $prefix = null,
        ?string $suffix = null,
        ?string $prepend = null,
        ?string $append = null
    ) {
        parent::__construct($color, $label, $hint, $cornerHint, $icon, $rightIcon, $prefix, $suffix, $prepend, $append);

        if (!$mask) {
            $mask = $this->getInputMask();
        }

        $this->mask          = $this->formatMask($mask);
        $this->emitFormatted = $emitFormatted;
    }

    private function formatMask(string $mask): string
    {
        if (Str::startsWith($mask, '[')) {
            return $mask;
        }

        return "'{$mask}'";
    }

    protected function getInputMask(): string
    {
        throw new Exception('Implement this method [getInputMask] on your component or pass [mask] in parameters');
    }
}