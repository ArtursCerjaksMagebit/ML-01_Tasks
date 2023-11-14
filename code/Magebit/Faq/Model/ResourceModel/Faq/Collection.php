<?php

namespace Magebit\Faq\Model\ResourceModel\Faq;

use Magebit\Faq\Api\Data\FaqModelInterface;
use Magebit\Faq\Model\FaqModel;
use Magebit\Faq\Model\ResourceModel\FaqResourceModel;
use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\Data\Collection\Db\FetchStrategyInterface as FetchStrategy;
use Magento\Framework\Data\Collection\EntityFactoryInterface as EntityFactory;
use Magento\Framework\Event\ManagerInterface as EventManager;
use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;
use Psr\Log\LoggerInterface as Logger;

/**
 * Needed for providing data to admin menus
 */
class Collection extends SearchResult implements SearchResultInterface
{
    /** @var string name of ID field */
    protected $_idFieldName = FaqModelInterface::KEY_ID;

    /**
     * Inserts main table and resource model names in parent constructor
     *
     * @inheritDoc
     */
    public function __construct(
        EntityFactory $entityFactory,
        Logger $logger,
        FetchStrategy $fetchStrategy,
        EventManager $eventManager,
        $mainTable = FaqModelInterface::MAIN_TABLE_NAME,
        $resourceModel = FaqResourceModel::class,
        $identifierName = null,
        $connectionName = null
    ) {
        parent::__construct(
            $entityFactory,
            $logger,
            $fetchStrategy,
            $eventManager,
            $mainTable,
            $resourceModel,
            $identifierName,
            $connectionName
        );
    }

    /**
     * Initializes collection
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(FaqModel::class, FaqResourceModel::class);
    }
}
