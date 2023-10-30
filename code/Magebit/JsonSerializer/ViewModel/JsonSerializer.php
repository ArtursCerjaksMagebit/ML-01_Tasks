<?php

namespace Magebit\JsonSerializer\ViewModel;

use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\View\Element\Block\ArgumentInterface;

/**
 * View model for serializing inputs to json
 */
class JsonSerializer implements ArgumentInterface
{
    /**
     * Injects Magento\Framework\Serialize\Serializer\Json
     */
    public function __construct(
        private readonly Json $json
    )
    {
    }

    /**
     * Serializes string to JSON
     *
     * @param array|bool|float|int|string|null $string $string
     * @return bool|string
     */
    public function serialize(array|bool|float|int|null|string $string): bool|string
    {
        return $this->json->serialize($string);
    }
}
