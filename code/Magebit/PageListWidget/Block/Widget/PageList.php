<?php

namespace Magebit\PageListWidget\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use Magebit\PageListWidget\Model\PageList as CmsPageList;

/**
 * This class is responsible for providing page-list.phtml
 * template with correct block variables
 */

class PageList extends Template implements BlockInterface
{
  /**
   * @var string $_template PageList block's template
   */
    protected $_template = "page-list.phtml";

  /**
   * Injects source model for CMS pages dependency,
   * satisfies extended class's constructor
   *
   * @param Template\Context $context
   * @param CmsPageList $cmsPageList
   * @param array $data
   */
    public function __construct(Template\Context $context, CmsPageList $cmsPageList, array $data = [])
    {
        parent::__construct($context, $data);
        $this->cmsPageList = $cmsPageList;
    }

  /**
   * Gets selected CMS pages from admin panel
   *
   * @return array
   */
    public function getSelectedPages(): array
    {
        if ($this->getData('display_mode') === 'all_pages') {
            return $this->cmsPageList->toOptionArray();
        } else {
            $selectedPages = explode(',', $this->getData('selected_pages'));
            $allPages = $this->cmsPageList->toOptionArray();

          //copies $allPages nested key values for use in array_search
            $allPageValues = [];
            $pageCount = count($allPages);
            for ($i = 0; $i < $pageCount; $i++) {
                $allPageValues[] = $allPages[$i]['value'];
            }

          //uses array_search to find what pages' indices from $allPages are selected
            $pages = [];
            foreach ($selectedPages as $selectedPage) {
                $key = array_search($selectedPage, $allPageValues);
                if ($key !== false) {
                    $pages[] = $allPages[$key];
                }
            }
            return $pages;
        }
    }
}
