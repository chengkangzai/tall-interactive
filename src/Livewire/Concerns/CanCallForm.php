<?php

namespace RalphJSmit\Tall\Interactive\Livewire\Concerns;

use Exception;

trait CanCallForm
{
    private function call(string $method, array $parameters = [])
    {
        if (! method_exists($this->formClass, $method)) {
            throw new Exception("Method [{$method}] does not exist on form class [{$this->formClass}].");
        }

        return app()->call(
            [$this->formClass, $method],
            array_merge([
                'close' => fn (string $actionable = null) => $this->close($actionable),
                'forceClose' => fn () => $this->forceClose(),
                'formVersion' => $this->formVersion,
                'livewire' => $this,
                'model' => $this->model,
            ], $parameters)
        );
    }
}
