<?php

namespace Magebit\Faq\Controller\Adminhtml\Faq;

use Magebit\Faq\Api\FaqRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Ui\Component\MassAction\Filter;

/**
 * Contains protected functions for actions to inherit
 */
abstract class AbstractAction extends Action
{
    /** @var string redirect to grid url */
    protected string $redirectGridUrl = '*/*/index';
    /** @var string redirect to form url */
    protected string $redirectFormUrl = '*/*/edit';

    /**
     * Authorization level of a basic admin session
     */
    public const ADMIN_RESOURCE = 'Magebit_Faq::faq_manage';

    /**
     * Injects dependencies (Filter and Faq Repository)
     *
     * @param Context $context
     * @param Filter $filter
     * @param FaqRepositoryInterface $faqRepository
     */
    public function __construct(
        Context $context,
        protected Filter $filter,
        protected FaqRepositoryInterface $faqRepository,
    ) {
        parent::__construct($context);
    }

    /**
     * Return to grid
     *
     * @return ResultInterface
     */
    protected function generateRedirectToGrid(): ResultInterface
    {
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath($this->redirectGridUrl);

        return $resultRedirect;
    }

    /**
     * Return to FAQ's edit form
     *
     * @param string|int $id
     * @param bool $current
     * @return ResultInterface
     */
    protected function generateRedirectToForm(string|int $id, bool $current = false): ResultInterface
    {
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath($this->redirectFormUrl, ['id' => $id, '_current' => $current]);

        return $resultRedirect;
    }

    /**
     * Checks whether user has Magebit_Faq::faq_manage auth
     *
     * @return bool
     */
    protected function _isAllowed(): bool
    {
        return $this->_authorization->isAllowed(self::ADMIN_RESOURCE);
    }
}
