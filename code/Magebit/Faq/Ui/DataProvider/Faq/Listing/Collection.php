<?php
namespace Magebit\Faq\Ui\DataProvider\Faq\Listing;

use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;

class Collection extends SearchResult
{
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
