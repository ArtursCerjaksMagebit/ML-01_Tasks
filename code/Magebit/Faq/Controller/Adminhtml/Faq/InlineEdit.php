<?php

namespace Magebit\Faq\Controller\Adminhtml\Faq;

use Magebit\Faq\Api\FaqRepositoryInterface;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\Result\Json;
use Magento\Ui\Component\MassAction\Filter;

/** Handles inline editing of FAQs from grid/listing */
class InlineEdit extends AbstractAction
{
    /**
     * Inject dependencies (JsonFactory)
     *
     * @inheritDoc
     */
    public function __construct(
        Context $context,
        Filter $filter,
        FaqRepositoryInterface $faqRepository,
        protected JsonFactory $resultJsonFactory,
    ) {
        parent::__construct(
            $context,
            $filter,
            $faqRepository
        );
    }

    /**
     * Lets user inline edit questions from grid
     */
    public function execute(): Json
    {
        $resultJson = $this->resultJsonFactory->create();
        $postItems = $this->getRequest()->getParam('items', []);
        if (!($this->getRequest()->getParam('isAjax') && count($postItems))) {
            return $resultJson->setData(
                [
                    'messages' => [
                        __('Please correct the data sent.')
                    ],
                    'error' => true,
                ]
            );
        } else {
            $messages = [];
            foreach (array_keys($postItems) as $faqId) {
                $faq = $this->faqRepository->get($faqId);
                try {
                    $faq->setData(array_merge($faq->getData(), $postItems[$faqId]));
                    $this->faqRepository->save($faq);
                } catch (\Exception $e) {
                    $messages[] = 'FAQ ID ' . $faqId . ':' . $e->getMessage();
                    $error = true;
                }
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error ?? false
        ]);
    }
}
