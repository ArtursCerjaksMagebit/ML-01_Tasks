<?php

namespace Magebit\Faq\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magebit\Faq\Model\FaqModel;

/**
 * Resource model for Faq entity
 */

class FaqResourceModel extends AbstractDb
{
    /**
     * Links ResourceModel with corresponding db table on primary key
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(FaqModel::MAIN_TABLE_NAME, FaqModel::KEY_ID);
    }
}
