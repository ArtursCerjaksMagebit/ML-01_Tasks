<?php

namespace MageMastery\ViewModelExample\Block;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use MageMastery\ViewModelExample\Model\Model;

class ViewModel implements ArgumentInterface
{
    public function __construct(
        protected Model $model
    ){}

    public function sayHi() {
        return $this->model->sayHi();
    }
}
