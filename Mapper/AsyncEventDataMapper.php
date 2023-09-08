<?php
declare(strict_types=1);

namespace MageOS\AsyncEventsAdminUi\Mapper;

use MageOS\AsyncEventsAdminUi\Api\Data\AsyncEventInterface;
use MageOS\AsyncEventsAdminUi\Api\Data\AsyncEventInterfaceFactory;
use MageOS\AsyncEventsAdminUi\Model\AsyncEventModel;
use Magento\Framework\DataObject;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Converts a collection of AsyncEvent entities to an array of data transfer objects.
 */
class AsyncEventDataMapper
{
    /**
     * @var AsyncEventInterfaceFactory
     */
    private AsyncEventInterfaceFactory $entityDtoFactory;

    /**
     * @param AsyncEventInterfaceFactory $entityDtoFactory
     */
    public function __construct(
        AsyncEventInterfaceFactory $entityDtoFactory
    )
    {
        $this->entityDtoFactory = $entityDtoFactory;
    }

    /**
     * Map magento models to DTO array.
     *
     * @param AbstractCollection $collection
     *
     * @return array|AsyncEventInterface[]
     */
    public function map(AbstractCollection $collection): array
    {
        $results = [];
        /** @var AsyncEventModel $item */
        foreach ($collection->getItems() as $item) {
            /** @var AsyncEventInterface|DataObject $entityDto */
            $entityDto = $this->entityDtoFactory->create();
            $entityDto->addData($item->getData());

            $results[] = $entityDto;
        }

        return $results;
    }
}
