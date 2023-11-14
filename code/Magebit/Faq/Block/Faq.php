<?php

namespace Magebit\Faq\Block;

use Magebit\Faq\Model\FaqModel;
use Magebit\Faq\Model\FaqRepository;
use Magento\Framework\View\Element\BlockInterface;
use Magento\Framework\View\Element\Template;

/** Block class for faq-list.phtml template */
class Faq extends Template implements BlockInterface
{
    /** @var string template file name */
    protected $_template = "faq-list.phtml";

    /**
     * Inject dependencies (FaqRepository)
     *
     * @param FaqRepository $faqRepository
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct(
        protected FaqRepository $faqRepository,
        Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * Gets list of FAQs by status (default 1 = active)
     *
     * And sorts them by position
     *
     * @param int|string $status
     * @return FaqModel[]
     */
    public function getFaqsByStatus(int|string $status = 1): array
    {
        $faqList = $this->faqRepository->getList();

        $faqsWithStatus = [];
        foreach ($faqList as $faq) {
            if ($faq->getStatus() === (string)$status) {
                $faqsWithStatus[] = $faq;
            }
        }

        // Sort array by position (asc)
        usort($faqsWithStatus, function ($faq1, $faq2) {
            return $faq1->getPosition() <=> $faq2->getPosition();
        });

        return $faqsWithStatus;
    }
}
