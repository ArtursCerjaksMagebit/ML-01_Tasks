<?php

namespace Magebit\Faq\Model\ResourceModel\Faq;

use Magebit\Faq\Model\FaqModel;
use Magebit\Faq\Model\ResourceModel\FaqResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * Initializes collection
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(FaqModel::class, FaqResourceModel::class);
    }
}
