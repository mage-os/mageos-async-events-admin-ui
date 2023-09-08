<?php
declare(strict_types=1);

namespace MageOS\AsyncEventsAdminUi\Model\ResourceModel;

use MageOS\AsyncEventsAdminUi\Api\Data\AsyncEventInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class AsyncEventResource extends AbstractDb
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'async_event_subscriber_resource_model';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('async_event_subscriber', AsyncEventInterface::SUBSCRIPTION_ID);
        $this->_useIsObjectNew = true;
    }
}
