<?php
declare(strict_types=1);

namespace MageOS\AsyncEventsAdminUi\Block\Form\AsyncEvent;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\UrlInterface;

/**
 * Generic (form) button for Asynchronous Event Subscriber entity.
 */
class GenericButton
{
    private Context $context;
    private UrlInterface $urlBuilder;

    public function __construct(
        Context $context
    ) {
        $this->context = $context;
        $this->urlBuilder = $context->getUrlBuilder();
    }

    public function getSubscriptionId(): int
    {
        return (int)$this->context->getRequest()->getParam('subscription_id');
    }

    /**
     * Wrap button specific options to settings array
     */
    protected function wrapButtonSettings(
        string $label,
        string $class,
        string $onclick = '',
        array  $dataAttribute = [],
        int    $sortOrder = 0
    ): array {
        return [
            'label' => $label,
            'on_click' => $onclick,
            'data_attribute' => $dataAttribute,
            'class' => $class,
            'sort_order' => $sortOrder
        ];
    }

    protected function getUrl(string $route, array $params = []): string
    {
        return $this->urlBuilder->getUrl($route, $params);
    }
}
