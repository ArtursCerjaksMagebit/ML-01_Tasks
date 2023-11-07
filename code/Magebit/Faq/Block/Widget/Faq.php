<?php

namespace Magebit\Faq\Block\Widget;

use Magebit\Faq\Model\FaqModel;
use Magebit\Faq\Model\FaqRepository;
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

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
        array $data = [])
    {
        parent::__construct($context, $data);
    }

    /**
     * Gets list of FAQs by status (default 1 = active)
     *
     * @param int $status
     * @return FaqModel[]
     */
    public function getFaqsByStatus(int $status = 1): array
    {
        $faqList = $this->faqRepository->getList();

        $faqsWithStatus = [];
        foreach ($faqList as $faq) {
            if ($faq->getStatus() === $status) {
                $faqsWithStatus[] = $faq;
            }
        }

        return $faqsWithStatus;
    }
}
