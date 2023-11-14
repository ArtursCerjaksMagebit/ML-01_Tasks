<?php

namespace Magebit\Faq\Controller\Adminhtml\Faq;

use Magebit\Faq\Api\FaqRepositoryInterface;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;

/** Handles edit and creation of FAQs */
class Edit extends AbstractAction implements HttpGetActionInterface
{
    /**
     * Inject dependency (resultPageFactory)
     *
     * @inheritDoc
     */
    public function __construct(
        Context $context,
        Filter $filter,
        FaqRepositoryInterface $faqRepository,
        protected PageFactory $pageFactory
    ) {
        parent::__construct(
            $context,
            $filter,
            $faqRepository
        );
    }

    /**
     * @inheritDoc
     */
    public function execute()
    {
        $resultPage = $this->pageFactory->create();
        $resultPage->setActiveMenu('Magento_Backend::content');
        $resultPage->getConfig()
            ->getTitle()
            ->prepend(__('Edit question'));
        return $resultPage;
    }
}
