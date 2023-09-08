<?php
declare(strict_types=1);

namespace MageOS\AsyncEventsAdminUi\Model\ResourceModel\AsyncEventModel;

use MageOS\AsyncEventsAdminUi\Model\AsyncEventModel;
use MageOS\AsyncEventsAdminUi\Model\ResourceModel\AsyncEventResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class AsyncEventCollection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'async_event_subscriber_collection';

    /**
     * Initialize collection model.
     */
    protected function _construct()
    {
        $this->_init(AsyncEventModel::class, AsyncEventResource::class);
    }
}
