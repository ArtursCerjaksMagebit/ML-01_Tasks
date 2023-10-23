<?php

declare(strict_types=1);

namespace MageMastery\ViewModelExample\Controller\Index;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\View\Result\Page;

class Index implements ActionInterface
{
    public function __construct(private readonly PageFactory $resultPageFactory) {}

    public function execute(): Page
    {
        return $this->resultPageFactory->create();
    }
}
