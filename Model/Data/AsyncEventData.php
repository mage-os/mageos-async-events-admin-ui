<?php
declare(strict_types=1);

namespace MageOS\AsyncEventsAdminUi\Model\Data;

use MageOS\AsyncEventsAdminUi\Api\Data\AsyncEventInterface;
use Magento\Framework\DataObject;

class AsyncEventData extends DataObject implements AsyncEventInterface
{
    /**
     * Getter for SubscriptionId.
     *
     * @return int|null
     */
    public function getSubscriptionId(): ?int
    {
        return $this->getData(self::SUBSCRIPTION_ID) === null ? null
            : (int)$this->getData(self::SUBSCRIPTION_ID);
    }

    /**
     * Setter for SubscriptionId.
     *
     * @param int|null $subscriptionId
     *
     * @return void
     */
    public function setSubscriptionId(?int $subscriptionId): void
    {
        $this->setData(self::SUBSCRIPTION_ID, $subscriptionId);
    }

    /**
     * Getter for EventName.
     *
     * @return string|null
     */
    public function getEventName(): ?string
    {
        return $this->getData(self::EVENT_NAME);
    }

    /**
     * Setter for EventName.
     *
     * @param string|null $eventName
     *
     * @return void
     */
    public function setEventName(?string $eventName): void
    {
        $this->setData(self::EVENT_NAME, $eventName);
    }

    /**
     * Getter for RecipientUrl.
     *
     * @return string|null
     */
    public function getRecipientUrl(): ?string
    {
        return $this->getData(self::RECIPIENT_URL);
    }

    /**
     * Setter for RecipientUrl.
     *
     * @param string|null $recipientUrl
     *
     * @return void
     */
    public function setRecipientUrl(?string $recipientUrl): void
    {
        $this->setData(self::RECIPIENT_URL, $recipientUrl);
    }

    /**
     * Getter for VerificationToken.
     *
     * @return string|null
     */
    public function getVerificationToken(): ?string
    {
        return $this->getData(self::VERIFICATION_TOKEN);
    }

    /**
     * Setter for VerificationToken.
     *
     * @param string|null $verificationToken
     *
     * @return void
     */
    public function setVerificationToken(?string $verificationToken): void
    {
        $this->setData(self::VERIFICATION_TOKEN, $verificationToken);
    }

    /**
     * Getter for Status.
     *
     * @return bool|null
     */
    public function getStatus(): ?bool
    {
        return $this->getData(self::STATUS) === null ? null
            : (bool)$this->getData(self::STATUS);
    }

    /**
     * Setter for Status.
     *
     * @param bool|null $status
     *
     * @return void
     */
    public function setStatus(?bool $status): void
    {
        $this->setData(self::STATUS, $status);
    }

    /**
     * Getter for Metadata.
     *
     * @return string|null
     */
    public function getMetadata(): ?string
    {
        return $this->getData(self::METADATA);
    }

    /**
     * Setter for Metadata.
     *
     * @param string|null $metadata
     *
     * @return void
     */
    public function setMetadata(?string $metadata): void
    {
        $this->setData(self::METADATA, $metadata);
    }

    /**
     * Getter for StoreId.
     *
     * @return int|null
     */
    public function getStoreId(): ?int
    {
        return $this->getData(self::STORE_ID) === null ? null
            : (int)$this->getData(self::STORE_ID);
    }

    /**
     * Setter for StoreId.
     *
     * @param int|null $storeId
     *
     * @return void
     */
    public function setStoreId(?int $storeId): void
    {
        $this->setData(self::STORE_ID, $storeId);
    }
}
