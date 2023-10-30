<?php
declare(strict_types=1);

namespace MageOS\AsyncEventsAdminUi\Ui\Source;

use MageOS\AsyncEventsAdminUi\Model\Config;

class EventNames implements \Magento\Framework\Option\ArrayInterface
{
    public function __construct(
        private readonly Config $config
    ) {
    }

    public function toOptionArray()
    {
        $asyncEvents = array_keys($this->config->get());
        sort($asyncEvents);
        return array_map(
            function (string $eventName): array {
                return [
                    'value' => $eventName,
                    'label' => $eventName,
                ];
            },
            $asyncEvents
        );
    }
}
