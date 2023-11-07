<?php

namespace Magebit\Faq\Ui\Component\Listing\Column;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class FaqActions extends Column
{
    /**
     * Inject deps (UrlInterface)
     *
     * @param UrlInterface $urlBuilder
     * @inheritDoc
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        private readonly UrlInterface $urlBuilder,
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


    //TODO: Place all actionsColumn actions here
    //TODO: Verify whether path works
    //TODO: If paths work, remove urlBuilder dep and constructor
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
                    $item[$this->getData('name')] = [
                        'delete' => [
                            'href' => '/delete',
                            'label' => __('Delete')
                        ]
                    ];
                }
            }

        return $dataSource;
    }
}

//
//['edit'] = [
//    'href' => $this->urlBuilder->getUrl(
//        'magebit_faq/*/edit',
//        ['id' => $item['entity_id'], 'store' => $storeId]
//    ),
//    'label' => __('Edit'),
//    'hidden' => false
//];
