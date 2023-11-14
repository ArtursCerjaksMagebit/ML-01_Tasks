<?php

namespace Magebit\Faq\Ui\Component\Listing\Column;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

/** Actions for FAQ grid/listing */
class FaqActions extends Column
{
    const URL_PATH_EDIT = 'magebit_faq/faq/edit';
    const URL_PATH_DELETE = 'magebit_faq/faq/delete';

    /**
     * Inject deps (UrlInterface)
     *
     * @param UrlInterface $urlBuilder
     * @inheritDoc
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        protected UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    )
    {
        parent::__construct(
        $context,
        $uiComponentFactory,
        $components,
        $data);
    }

    /**
     * Prepare data source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource): array
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                if (isset($item['id'])) {
                    $faqTitle = $item['question'];
                    $item[$this->getData('name')] = [
                        'delete' => [
                            'href' => $this->urlBuilder->getUrl(
                                self::URL_PATH_DELETE,
                                [
                                    'id' => $item['id']
                                ]
                            ),
                            'label' => __('Delete'),
                            'confirm' => [
                                'title' => __('Delete FAQ: %1', $faqTitle),
                                'message' => __('Are you sure you want to delete %1', $faqTitle)
                            ],
                            'post' => true
                        ],
                        'edit' => [
                            'href' => $this->urlBuilder->getUrl(
                                self::URL_PATH_EDIT,
                                [
                                    'id' => $item['id']
                                ]
                            ),
                            'label' => __('Edit'),

                        ]
                    ];
                }
            }
        }
        return $dataSource;
    }
}
