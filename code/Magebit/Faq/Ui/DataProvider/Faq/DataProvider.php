<?php

namespace Magebit\Faq\Ui\DataProvider\Faq;

use Magebit\Faq\Model\FaqModel;
use Magebit\Faq\Model\ResourceModel\Faq\Collection;
use Magebit\Faq\Model\ResourceModel\Faq\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\DataProviderInterface;
use Magento\Ui\DataProvider\Modifier\PoolInterface;
use Magento\Ui\DataProvider\ModifierPoolDataProvider;


class DataProvider extends ModifierPoolDataProvider implements DataProviderInterface
{
    /** @var Collection */
    protected $collection;

    /** @var mixed */
    protected $loadedData;

    /**
     * Inject dependencies (FAQ collection factory, data persistor)
     *
     * @inheritDoc
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        protected CollectionFactory $faqCollectionFactory,
        protected DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = [],
        PoolInterface $pool = null
    )
    {
        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $meta,
            $data,
            $pool
        );
    }

    /**
     * @inheritDoc
     */
    public function getData(): array
    {
        //check is data is already loaded
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        //add data to $this->loadedData
        $items = $this->collection->getItems();
        /** @var FaqModel $faq */
        foreach ($items as $faq) {
            $this->loadedData[$faq->getId()] = $faq->getData();
        }

        //get persisted data from 'magebit_faq'
        $data = $this->dataPersistor->get('magebit_faq');

        //set loaded data to persist in 'magebit_faq' if persisted data was empty
        if (!empty($data)) {
            $faq = $this->collection->getNewEmptyItem();
            $faq->setData($data);
            $this->loadedData[$faq->getId()] = $faq->getData();
            $this->dataPersistor->clear('magebit_faq');
        }
        return $this->loadedData;
    }
}
