<?php

namespace Magebit\Faq\Controller\Adminhtml\Faq;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultInterface;

/** Handles deletion of FAQs */
class Delete extends AbstractAction implements HttpPostActionInterface
{
    /**
     * Delete FAQ based on param id
     */
    public function execute(): ResultInterface
    {
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            try {
                $this->faqRepository->deleteById($id);
                $this->messageManager->addSuccessMessage(__('FAQ removed'));
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $this->generateRedirectToForm($id);
            }
        }

        return $this->generateRedirectToGrid();
    }
}
