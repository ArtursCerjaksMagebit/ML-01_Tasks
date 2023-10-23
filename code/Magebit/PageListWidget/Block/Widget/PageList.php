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
   * Sets and normalizes CMS pages per admin selection
   * for the template
   *
   * @return void
   */
  public function setPages(): void
  {
    if ($this->getData('display_mode') === 'all_pages') {
      $this->setData('selected_pages', $this->cmsPageList->toOptionArray());
    }

    if ($this->getData('display_mode') === 'specific_pages') {
      $selectedPages = explode(',',$this->getData('selected_pages'));
      $allPages = $this->cmsPageList->toOptionArray();

      //copies $allPages nested key values for use in array_search
      $allPageValues = [];
      for ($i = 0; $i < count($allPages); $i++) {
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

      $this->setData('selected_pages', $pages);
    }

  }

}
