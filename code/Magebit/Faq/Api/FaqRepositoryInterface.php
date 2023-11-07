<?php


namespace Magebit\Faq\Api;

use Magebit\Faq\Model\FaqModel;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\StateException;

/**
 * @api
 */
interface FaqRepositoryInterface
{
    /**
     * Get faq by id
     *
     * @param int $faqId
     * @return FaqModel
     * @throws NoSuchEntityException
     */
    public function get(int $faqId): FaqModel;

    /**
     * Gets list of faqs
     *
     * @return FaqModel[]
     */
    public function getList();

    /**
     * Create faq
     *
     * @param FaqModel $faq
     * @return FaqModel
     * @throws CouldNotSaveException
     */
    public function save(FaqModel $faq): FaqModel;


    /**
     * Delete faq by object
     *
     * @param FaqModel $faq
     * @return bool Will returned True if deleted
     * @throws InputException
     * @throws StateException
     * @throws CouldNotDeleteException
     */
    public function delete(FaqModel $faq): bool;

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
