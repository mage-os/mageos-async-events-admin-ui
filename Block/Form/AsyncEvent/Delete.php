<?php
declare(strict_types=1);

namespace MageOS\AsyncEventsAdminUi\Block\Form\AsyncEvent;

use MageOS\AsyncEventsAdminUi\Api\Data\AsyncEventInterface;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Delete entity button.
 */
class Delete extends GenericButton implements ButtonProviderInterface
{
    /**
     * Retrieve Delete button settings.
     */
    public function getButtonData(): array
    {
        if (!$this->getSubscriptionId()) {
            return [];
        }

        return $this->wrapButtonSettings(
            __('Delete')->getText(),
            'delete',
            sprintf(
                "deleteConfirm('%s', '%s')",
                __('Are you sure you want to delete this Asynchronous Event Subscriber?'),
                $this->getUrl(
                    '*/*/delete',
                    ['subscription_id' => $this->getSubscriptionId()]
                )
            ),
            [],
            20
        );
    }
}
