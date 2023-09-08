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
     *
     * @return array
     */
    public function getButtonData(): array
    {
        if (!$this->getSubscriptionId()) {
            return [];
        }

        return $this->wrapButtonSettings(
            __('Delete')->getText(),
            'delete',
            sprintf("deleteConfirm('%s', '%s')",
                __('Are you sure you want to delete this asyncevent?'),
                $this->getUrl(
                    '*/*/delete',
                    [AsyncEventInterface::SUBSCRIPTION_ID => $this->getSubscriptionId()]
                )
            ),
            [],
            20
        );
    }
}
