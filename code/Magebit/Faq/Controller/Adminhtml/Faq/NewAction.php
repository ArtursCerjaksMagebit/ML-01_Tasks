<?php

namespace Magebit\Faq\Controller\Adminhtml\Faq;


use Magebit\Faq\Api\FaqRepositoryInterface;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\PageFactory;
use Magento\Ui\Component\MassAction\Filter;

/**
 * Redirects to edit action which is used for creating a new FAQ
 */
class NewAction extends AbstractAction
{
    /**
     * Redirect to form for editing a FAQ (also used for new)
     *
     * @inheritDoc
     */
    public function execute()
    {
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath($this->redirectFormUrl);
    }
}
