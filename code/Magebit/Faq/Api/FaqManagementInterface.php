<?php

namespace Magebit\Faq\Api;

use Magebit\Faq\Api\Data\FaqModelInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

/** @api for FaqManagement class */
interface FaqManagementInterface
{
    /**
     * Enables a question by setting status to 1
     *
     * @param int|string $id
     * @return FaqModelInterface
     * @throws NoSuchEntityException
     * @throws CouldNotSaveException
     */
    public function enableQuestion(int|string $id): FaqModelInterface;

    /**
     * Disables a question by setting status to 0
     *
     * @param int $id
     * @return FaqModelInterface
     * @throws NoSuchEntityException
     * @throws CouldNotSaveException
     */
    public function disableQuestion(int $id): FaqModelInterface;
}
