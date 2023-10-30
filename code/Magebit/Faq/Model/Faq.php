<?php

namespace Magebit\Faq\Model;

use Magebit\Faq\Model\ResourceModel\Faq\Collection;
use Magento\Framework\Model\AbstractModel;

/**
 * Model class for Faq entity
 */
class Faq extends AbstractModel
{
    /**
     * Links model to resourceModel
     *
     * @return void
     */
    public function _construct(): void
    {
        $this->_init(Collection::class);
    }
}
