<?php

namespace Magebit\Faq\Controller\Adminhtml\Faq;

use Magebit\Faq\Api\FaqManagementInterface;
use Magebit\Faq\Api\FaqRepositoryInterface;
use Magebit\Faq\Model\ResourceModel\Faq\Collection;
use Magebit\Faq\Model\ResourceModel\Faq\CollectionFactory;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Eav\Model\Entity\Collection\AbstractCollection;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Ui\Component\MassAction\Filter;

/** Contains protected functions for mass actions to inherit from */
abstract class AbstractMassAction extends AbstractAction
{


    protected string $redirectUrl = '*/*/index';

    /**
     * Inject dependencies (CollectionFactory, FaqManagementInterface)
     *
     * @inheritDoc
     */
    public function __construct(
        Context $context,
        protected Filter $filter,
        protected CollectionFactory $collectionFactory,
        protected FaqManagementInterface $faqManagement,
        protected FaqRepositoryInterface $faqRepository
    )
    {
        parent::__construct(
            $context,
            $filter,
            $faqRepository
        );
    }

    /**
     * Execute massAction() on collection
     *
     * @return ResponseInterface|ResultInterface
     */
    public function execute(): ResponseInterface|ResultInterface
    {
        try {
            /** @var Collection $collection */
            $collection = $this->filter->getCollection($this->collectionFactory->create());
            return $this->massAction($collection);
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            /** @var Redirect $resultRedirect */
            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            return $resultRedirect->setPath($this->redirectUrl);
        }
    }

    /**
     * Return component referer url
     *
     * @return string
     */
    protected function getComponentRefererUrl(): string
    {
        return $this->filter->getComponentRefererUrl()?: $this->redirectUrl;
    }

    /**
     * Execute action to collection
     *
     * @param AbstractCollection|Collection $collection
     * @return ResponseInterface|ResultInterface
     */
    abstract protected function massAction(AbstractCollection|Collection $collection);

    /**
     * Generate redirect back to grid
     *
     * @return ResponseInterface|ResultInterface
     */
    protected function generateRedirect(): ResponseInterface|ResultInterface
    {
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath($this->getComponentRefererUrl());

        return $resultRedirect;
    }
}
