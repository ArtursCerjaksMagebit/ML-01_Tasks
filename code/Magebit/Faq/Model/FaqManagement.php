<?php

namespace Magebit\Faq\Model;

use Magebit\Faq\Api\Data\FaqModelInterface;
use Magebit\Faq\Api\FaqManagementInterface;
use Magebit\Faq\Api\FaqRepositoryInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

/** FaqManagement class for FaqModel */
class FaqManagement implements FaqManagementInterface
{
    /**
     * Injects dependencies
     *
     * @param FaqRepositoryInterface $faqRepository
     */
    public function __construct(
        protected FaqRepositoryInterface $faqRepository,
    )
    {}

    /**
     * @inheritDoc
     */
    public function enableQuestion(int|string $id): FaqModelInterface
    {
        return $this->changeStatus($id, 1);
    }

    /**
     * @inheritDoc
     */
    public function disableQuestion(int|string $id): FaqModelInterface
    {
        return $this->changeStatus($id, 0);
    }

    /**
     * Changes status, DRY
     *
     * @throws NoSuchEntityException
     * @throws CouldNotSaveException
     */
    private function changeStatus(int|string $id, int $status): FaqModelInterface
    {
        try {
            $faq = $this->faqRepository->get((int)$id);
            $faq->setStatus($status);
            $this->faqRepository->save($faq);
        } catch (NoSuchEntityException $e) {
            throw new NoSuchEntityException(__($e->getMessage()));
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }

        return $faq;
    }
}
