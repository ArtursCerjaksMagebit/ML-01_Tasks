<?php

declare(strict_types=1);

namespace MageMastery\FirstLayout\Controller\Page;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Element\Template;

class View implements ActionInterface
{
    public function __construct(private readonly PageFactory $resultPageFactory) {}

    public function execute(): Page
    {
        $page = $this->resultPageFactory->create();

        /** @var Template $block */
        $block = $page->getLayout()->getBlock('mage-mastery.first.layout.example');

        $block->setData('custom_parameter', 'Data from the Controller');

        return $page;
    }
}
