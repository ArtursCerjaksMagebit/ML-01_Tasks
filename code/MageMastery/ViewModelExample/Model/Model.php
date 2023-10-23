<?php

namespace MageMastery\ViewModelExample\Model;

class Model
{
    public function __construct(
        private readonly string $message = "Hi"
    )
    {
    }

    public function sayHi(): string
    {
        return $this->message;
    }
}
