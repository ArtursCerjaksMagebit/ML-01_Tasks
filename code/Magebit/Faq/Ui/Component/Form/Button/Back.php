<?php

namespace Magebit\Faq\Ui\Component\Form\Button;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Back button for magebit_faq_faq_form.xml
 */
class Back implements ButtonProviderInterface
{
    /**
     * Injects dependencies (Context)
     */
    public function __construct(
        protected Context $context
    )
    {}

    /**
     * Retrieve button configuration
     *
     * @return array
     */
    public function getButtonData(): array
    {
        return [
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", $this->getBackUrl()),
            'class' => 'back',
            'sort_order' => 10
        ];
    }

    /**
     * Retrieve url back to grid
     *
     * @return string
     */
    private function getBackUrl(): string
    {
        return $this->context->getUrlBuilder()->getUrl('*/*/index');
    }
}
