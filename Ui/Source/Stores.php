<?php
declare(strict_types=1);

namespace MageOS\AsyncEventsAdminUi\Ui\Source;

use Magento\Store\Api\Data\StoreInterface;
use Magento\Store\Model\StoreManagerInterface;

class Stores implements \Magento\Framework\Option\ArrayInterface
{
    private StoreManagerInterface $storeManager;

    public function __construct(
        StoreManagerInterface $storeManager
    ) {
        $this->storeManager = $storeManager;
    }

    public function toOptionArray()
    {
        $stores = $this->storeManager->getStores();
        $options = array_map(
            function (StoreInterface $store): array {
                return [
                    'value' => $store->getId(),
                    'label' => $store->getName(),
                ];
            },
            $stores
        );
        array_unshift($options, ['value' => '0', 'label' => __('All Stores')]);
        return $options;
    }
}
