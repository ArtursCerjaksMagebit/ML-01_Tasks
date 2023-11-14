<?php
namespace Magebit\Faq\Ui\DataProvider\Faq\Listing;

use Magebit\Faq\Api\Data\FaqModelInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;

/** Collection for FAQ listing */
class Collection extends SearchResult
{
    protected $_mainTable = FaqModelInterface::MAIN_TABLE_NAME;

    /**
     * Init select
     *
     * @return Collection
     */
    protected function _initSelect(): Collection
    {
        parent::_initSelect();
        return $this;
    }
}
