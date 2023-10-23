<?php

declare(strict_types=1);

namespace MageMastery\FirstPage\Controller\Page;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\Result\JsonFactory;


class View implements ActionInterface
{

    public function __construct(private readonly JsonFactory $resultJsonFactory) {}

    public function execute(): Json
    {
        $resultJson = $this->resultJsonFactory->create();
        return $resultJson->setData([
            'message' => 'My First CmsPages'
        ]);
    }
}
