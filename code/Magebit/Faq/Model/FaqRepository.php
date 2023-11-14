<?php

namespace Magebit\Faq\Model;

use Exception;
use Magebit\Faq\Api\Data\FaqModelInterface;
use Magebit\Faq\Api\FaqRepositoryInterface;
use Magebit\Faq\Model\ResourceModel\FaqResourceModel;
use Magebit\Faq\Model\ResourceModel\Faq\CollectionFactory as FaqCollectionFactory;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Repository class for Faq entity
 */
class FaqRepository implements FaqRepositoryInterface
{
    /**
     * Inject dependencies of Faq model & resource model
     *
     * @param FaqModel $faq
     * @param FaqResourceModel $faqResourceModel
     * @param FaqCollectionFactory $faqCollectionFactory
     */
    public function __construct(
        protected FaqModelInterface $faq,
        protected FaqResourceModel $faqResourceModel,
        protected FaqCollectionFactory $faqCollectionFactory,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function get(int|string $faqId): FaqModelInterface
    {
        $faq = $this->faq;
        $this->faqResourceModel->load($faq, (int)$faqId);
        if (!$faq->getId()) {
            throw new NoSuchEntityException(__('Entity with such id does not exist: ', $faqId));
        }
        return $faq;
    }

    /**
     * @inheritDoc
     */
    public function getList(): array
    {
        return $this->faqCollectionFactory->create()->getItems();
    }

    /**
     * @inheritDoc
     */
    public function save(FaqModelInterface $faq): FaqModelInterface
    {
        try {
            $this->faqResourceModel->save($faq);
        } catch (Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }
        return $faq;
    }

    /**
     * @inheritDoc
     */
    public function delete(FaqModelInterface $faq): bool
    {
        try {
            $this->faqResourceModel->delete($faq);
            return true;
        } catch (Exception $e) {
            throw new CouldNotDeleteException(__($e->getMessage()));
        }
    }

    /**
     * @inheritDoc
     */
    public function deleteById($faqId): bool
    {
        return $this->delete($this->get($faqId));
    }
}
