<?php

namespace Magebit\Faq\Controller\Adminhtml\Faq;

use Magebit\Faq\Model\FaqManagement;
use Magebit\Faq\Model\ResourceModel\Faq\Collection;
use Magebit\Faq\Model\ResourceModel\Faq\CollectionFactory;
use Magento\Backend\App\Action\Context;
use Magento\Eav\Model\Entity\Collection\AbstractCollection;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;

class MassDisable extends AbstractMassAction implements HttpPostActionInterface
{
    /**
     * Inject dependencies (FaqManagement)
     *
     * @inheritDoc
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        private readonly FaqManagement $faqManagement
    )
    {
        parent::__construct($context, $filter, $collectionFactory);
    }

    /**
     * @inheritDoc
     */
    protected function massAction(AbstractCollection|Collection $collection)
    {
        $questionsDisabled = 0;
        foreach($collection->getAllIds() as $questionId) {
            $this->faqManagement->disableQuestion($questionId);
            $questionsDisabled++;
        }

        if ($questionsDisabled) {
            $this->messageManager->addSuccessMessage(__('A total of %1 record(s) were disabled.', $questionsDisabled));
        }

        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath($this->getComponentRefererUrl());

        return $resultRedirect;
    }
}
