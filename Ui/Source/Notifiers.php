<?php
declare(strict_types=1);

namespace MageOS\AsyncEventsAdminUi\Ui\Source;

class Notifiers implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Options are hard coded since this module only support HTTP
     *
     * @return array[]
     */
    public function toOptionArray()
    {
        return [
            [
                'value' => 'http',
                'label' => 'HTTP',
            ]
        ];
    }
}
