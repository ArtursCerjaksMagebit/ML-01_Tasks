<?php

namespace Magebit\Faq\Controller\Adminhtml\Faq;

use Magebit\Faq\Model\FaqRepository;
use Magebit\Faq\Model\ResourceModel\Faq\Collection;
use Magebit\Faq\Model\ResourceModel\Faq\CollectionFactory;
use Magento\Backend\App\Action\Context;
use Magento\Eav\Model\Entity\Collection\AbstractCollection;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;

class MassDelete extends AbstractMassAction implements HttpPostActionInterface
{
    /**
     * Inject dependencies (faqRepository)
     *
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     * @param FaqRepository $faqRepository
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        private readonly FaqRepository $faqRepository
    )
    {
        parent::__construct($context, $filter, $collectionFactory);
    }

    /**
     * @inheritDoc
     */
    public function massAction(AbstractCollection|Collection $collection)
    {
        $questionsDeleted = 0;
        foreach($collection->getAllIds() as $questionId) {
            $this->faqRepository->deleteById($questionId);
            $questionsDeleted++;
        }

        if ($questionsDeleted) {
            $this->messageManager->addSuccessMessage(__('A total of %1 record(s) were deleted.', $questionsDeleted));
        }

        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath($this->getComponentRefererUrl());

        return $resultRedirect;
    }
}
