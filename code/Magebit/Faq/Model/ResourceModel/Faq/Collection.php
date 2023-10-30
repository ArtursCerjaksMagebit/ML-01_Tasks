<?php

namespace Magebit\Faq\Model\ResourceModel\Faq;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Resource model for Faq entity
 */

class Collection extends AbstractDb
{
    /**
     * Links ResourceModel with corresponding db table on primary key
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init('magebit_faq', 'id');
    }
}
