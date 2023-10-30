<?php

namespace Magebit\PageListWidget\Model;

use Magento\Cms\Model\PageRepository;
use Magento\Framework\Api\Search\SearchCriteria;
use Magento\Framework\Data\OptionSourceInterface;

/**
 * Widget responsible for preparing a list of all or select pages
 */
class PageList implements OptionSourceInterface
{

    /**
     * @param PageRepository $pageRepository
     */
    public function __construct(readonly private PageRepository $pageRepository)
    {
    }

    /**
     * Returns list of CMS pages for widget.xml parameter
     *
     * @return array
     */

    public function toOptionArray(): array
    {
        $searchCriteria = new SearchCriteria();

        $pages = $this->pageRepository->getList($searchCriteria)->getItems();

        $pageList = [];
        foreach ($pages as $page) {
            $pageList[] = ['value' => $page->getIdentifier(), 'label' => $page->getTitle()];
        }

        return $pageList;
    }
}
