<?php


namespace Magebit\Faq\Api;

use Magebit\Faq\Api\Data\FaqModelInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\StateException;

/**
 * @api for Faq Repository class
 */
interface FaqRepositoryInterface
{
    /**
     * Get faq by id
     *
     * @param int $faqId
     * @return FaqModelInterface
     * @throws NoSuchEntityException
     */
    public function get(int $faqId): FaqModelInterface;

    /**
     * Gets list of faqs
     *
     * @return FaqModelInterface[]
     */
    public function getList(): array;

    /**
     * Create faq
     *
     * @param FaqModelInterface $faq
     * @return FaqModelInterface
     * @throws CouldNotSaveException
     */
    public function save(FaqModelInterface $faq): FaqModelInterface;


    /**
     * Delete faq by object
     *
     * @param FaqModelInterface $faq
     * @return bool Will returned True if deleted
     * @throws InputException
     * @throws StateException
     * @throws CouldNotDeleteException
     */
    public function delete(FaqModelInterface $faq): bool;

    /**
     * Delete category by identifier
     *
     * @param int $faqId
     * @return bool Will returned True if deleted
     * @throws InputException
     * @throws StateException
     * @throws NoSuchEntityException
     * @throws CouldNotDeleteException
     */
    public function deleteById(int $faqId): bool;
}
