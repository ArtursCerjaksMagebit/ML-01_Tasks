<?php

namespace Magebit\Faq\Model;

use Magebit\Faq\Model\Faq;
use Magebit\Faq\Model\ResourceModel\Faq\Collection as FaqResourceModel;

/**
 * Repository class for Faq entity
 */
class FaqRepository
{
    /**
     * Inject dependencies of Faq model & resource model
     *
     * @param Faq $faq
     * @param FaqResourceModel $faqResourceModel
     */
    public function __construct(
        protected Faq $faq,
        protected FaqResourceModel $faqResourceModel
    )
    {}

    /**
     * TODO: get, save, getList, delete, deleteById methods
     */
}
