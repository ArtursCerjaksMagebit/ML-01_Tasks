<?php

namespace Magebit\Faq\Controller\Adminhtml\Faq;

use Magebit\Faq\Model\ResourceModel\Faq\Collection;
use Magento\Eav\Model\Entity\Collection\AbstractCollection;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

/**
 * Disables FAQs from selection in admin grid
 */
class MassDisable extends AbstractMassAction implements HttpPostActionInterface
{
    /**
     * @inheritDoc
     */
    protected function massAction(AbstractCollection|Collection $collection): ResponseInterface|ResultInterface
    {
        $questionsDisabled = 0;
        foreach ($collection->getAllIds() as $questionId) {
            $this->faqManagement->disableQuestion($questionId);
            $questionsDisabled++;
        }

        if ($questionsDisabled) {
            $this->messageManager->addSuccessMessage(__('A total of %1 record(s) were disabled.', $questionsDisabled));
        }

        return $this->generateRedirect();
    }
}
