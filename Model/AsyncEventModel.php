<?php
declare(strict_types=1);

namespace MageOS\AsyncEventsAdminUi\Model;

use MageOS\AsyncEventsAdminUi\Model\ResourceModel\AsyncEventResource;
use Magento\Framework\Model\AbstractModel;

class AsyncEventModel extends AbstractModel
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'async_event_subscriber_model';

    /**
     * Initialize magento model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(AsyncEventResource::class);
    }
}
