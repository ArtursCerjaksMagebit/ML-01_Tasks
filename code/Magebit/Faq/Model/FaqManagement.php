<?php

namespace Magebit\Faq\Model;

use Magebit\Faq\Api\FaqManagementInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class FaqManagement implements FaqManagementInterface
{
    /**
     * Injects dependencies
     *
     * @param FaqRepository $faqRepository
     */
    public function __construct(
        protected FaqRepository $faqRepository,
    )
    {}

    /**
     * @inheritDoc
     */
    public function enableQuestion(int $id): FaqModel
    {
        try {
            $faq = $this->faqRepository->get($id);
            $faq->setStatus(1);
        } catch (NoSuchEntityException $e) {
            throw new NoSuchEntityException(__($e->getMessage()));
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }

        return $faq;
    }

    /**
     * @inheritDoc
     */
    public function disableQuestion(int $id): FaqModel
    {
        try {
            $faq = $this->faqRepository->get($id);
            $faq->setStatus(0);
        } catch (NoSuchEntityException $e) {
            throw new NoSuchEntityException(__($e->getMessage()));
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }

        return $faq;
    }
}
