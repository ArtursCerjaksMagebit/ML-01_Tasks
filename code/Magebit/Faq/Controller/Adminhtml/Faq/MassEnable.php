<?php

namespace Magebit\Faq\Controller\Adminhtml\Faq;

use Magebit\Faq\Model\ResourceModel\Faq\Collection;
use Magento\Eav\Model\Entity\Collection\AbstractCollection;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

/**
 * Enables FAQs from selection in admin grid
 */
class MassEnable extends AbstractMassAction implements HttpPostActionInterface
{
    /**
     * @inheritDoc
     */
    protected function massAction(AbstractCollection|Collection $collection): ResponseInterface|ResultInterface
    {
        $questionsEnabled = 0;
        foreach ($collection->getAllIds() as $questionId) {
            $this->faqManagement->enableQuestion($questionId);
            $questionsEnabled++;
        }

        if ($questionsEnabled) {
            $this->messageManager->addSuccessMessage(__('A total of %1 record(s) were enabled.', $questionsEnabled));
        }

        return $this->generateRedirect();
    }
}
