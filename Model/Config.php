<?php
declare(strict_types=1);

namespace MageOS\AsyncEventsAdminUi\Model;

use Magento\Framework\Config\DataInterface;

class Config
{
    public function __construct(
        private readonly DataInterface $dataStorage
    ) {
    }

    /**
     * Retrieve the content of all async_events.xml files
     */
    public function get(?string $key = null): array
    {
        return $this->dataStorage->get($key, []);
    }
}
