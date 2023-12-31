<?php
declare(strict_types=1);

namespace MageOS\AsyncEventsAdminUi\Query\AsyncEvent;

use MageOS\AsyncEvents\Model\ResourceModel\AsyncEvent\Collection as AsyncEventCollection;
use MageOS\AsyncEvents\Model\ResourceModel\AsyncEvent\CollectionFactory as AsyncEventCollectionFactory;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Api\SearchResultsInterfaceFactory;

/**
 * Get AsyncEvent list by search criteria query.
 */
class GetListQuery
{
    public function __construct(
        private readonly CollectionProcessorInterface  $collectionProcessor,
        private readonly AsyncEventCollectionFactory   $entityCollectionFactory,
        private readonly SearchCriteriaBuilder         $searchCriteriaBuilder,
        private readonly SearchResultsInterfaceFactory $searchResultFactory
    ) {
    }

    /**
     * Get AsyncEvent list by search criteria.
     */
    public function execute(?SearchCriteriaInterface $searchCriteria = null): SearchResultsInterface
    {
        /** @var AsyncEventCollection $collection */
        $collection = $this->entityCollectionFactory->create();

        if ($searchCriteria === null) {
            $searchCriteria = $this->searchCriteriaBuilder->create();
        } else {
            $this->collectionProcessor->process($searchCriteria, $collection);
        }

        /** @var SearchResultsInterface $searchResult */
        $searchResult = $this->searchResultFactory->create();
        $searchResult->setItems($collection->getItems());
        $searchResult->setTotalCount($collection->getSize());
        $searchResult->setSearchCriteria($searchCriteria);

        return $searchResult;
    }
}
