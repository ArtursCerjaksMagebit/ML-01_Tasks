<?php

namespace Magebit\Faq\Ui\Component\Form\Button;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Ui\Component\Control\Container;

/**
 * Save button for magebit_faq_faq_form.xml
 */
class Save implements ButtonProviderInterface
{
    /** @var string name of form where used */
    protected string $targetName = 'magebit_faq_faq_form.magebit_faq_faq_form';

    /**
     * Retrieves button configuration
     *
     * @return array
     */
    public function getButtonData(): array
    {
        return [
            'label' => __('Save'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => [
                    'buttonAdapter' => [
                        'actions' => [
                            [
                            'targetName' => $this->targetName,
                            'actionName' => 'save',
                            'params' => [
                                false
                                ]
                            ]
                        ]
                    ]
                ],
            ],
            'class_name' => Container::SPLIT_BUTTON,
            'options' => $this->getOptions(),
            'sort_order' => 90,
        ];
    }

    /**
     * Retrieves main button's sub-buttons/options
     *
     * @return array
     */
    private function getOptions(): array
    {
        $options[] = [
            'label' => __('Save & Close'),
            'id_hard' => 'save_and_close',
            'data_attribute' => [
                'mage-init' => [
                    'buttonAdapter' => [
                        'actions' => [
                            [
                                'targetName' => $this->targetName,
                                'actionName' => 'save',
                                'params' => [
                                    true,
                                    [
                                        'redirect' => 'back'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
        $options[] = [
            'label' => __('Save & New'),
            'id_hard' => 'save_and_new',
            'data_attribute' => [
                'mage-init' => [
                    'buttonAdapter' => [
                        'actions' => [
                            [
                                'targetName' => $this->targetName,
                                'actionName' => 'save',
                                'params' => [
                                    true,
                                    ['redirect' => 'new']
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        return $options;
    }
}
