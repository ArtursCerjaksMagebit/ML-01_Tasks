<?php

namespace Magebit\Faq\Controller\Adminhtml\Faq;

use Magebit\Faq\Model\ResourceModel\Faq\Collection;
use Magento\Eav\Model\Entity\Collection\AbstractCollection;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

/**
 * Deletes FAQs from selection in admin grid
 */
class MassDelete extends AbstractMassAction implements HttpPostActionInterface
{
    /**
     * @inheritDoc
     */
    public function massAction(AbstractCollection|Collection $collection): ResponseInterface|ResultInterface
    {
        $questionsDeleted = 0;
        foreach ($collection->getAllIds() as $questionId) {
            $this->faqRepository->deleteById($questionId);
            $questionsDeleted++;
        }

        if ($questionsDeleted) {
            $this->messageManager->addSuccessMessage(__('A total of %1 record(s) were deleted.', $questionsDeleted));
        }

        return $this->generateRedirect();
    }
}
