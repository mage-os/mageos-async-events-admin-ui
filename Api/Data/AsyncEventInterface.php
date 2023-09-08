<?php
declare(strict_types=1);

namespace MageOS\AsyncEventsAdminUi\Api\Data;

interface AsyncEventInterface
{
    /**
     * String constants for property names
     */
    public const SUBSCRIPTION_ID = "subscription_id";
    public const EVENT_NAME = "event_name";
    public const RECIPIENT_URL = "recipient_url";
    public const VERIFICATION_TOKEN = "verification_token";
    public const STATUS = "status";
    public const METADATA = "metadata";
    public const STORE_ID = "store_id";

    /**
     * Getter for SubscriptionId.
     *
     * @return int|null
     */
    public function getSubscriptionId(): ?int;

    /**
     * Setter for SubscriptionId.
     *
     * @param int|null $subscriptionId
     *
     * @return void
     */
    public function setSubscriptionId(?int $subscriptionId): void;

    /**
     * Getter for EventName.
     *
     * @return string|null
     */
    public function getEventName(): ?string;

    /**
     * Setter for EventName.
     *
     * @param string|null $eventName
     *
     * @return void
     */
    public function setEventName(?string $eventName): void;

    /**
     * Getter for RecipientUrl.
     *
     * @return string|null
     */
    public function getRecipientUrl(): ?string;

    /**
     * Setter for RecipientUrl.
     *
     * @param string|null $recipientUrl
     *
     * @return void
     */
    public function setRecipientUrl(?string $recipientUrl): void;

    /**
     * Getter for VerificationToken.
     *
     * @return string|null
     */
    public function getVerificationToken(): ?string;

    /**
     * Setter for VerificationToken.
     *
     * @param string|null $verificationToken
     *
     * @return void
     */
    public function setVerificationToken(?string $verificationToken): void;

    /**
     * Getter for Status.
     *
     * @return bool|null
     */
    public function getStatus(): ?bool;

    /**
     * Setter for Status.
     *
     * @param bool|null $status
     *
     * @return void
     */
    public function setStatus(?bool $status): void;

    /**
     * Getter for Metadata.
     *
     * @return string|null
     */
    public function getMetadata(): ?string;

    /**
     * Setter for Metadata.
     *
     * @param string|null $metadata
     *
     * @return void
     */
    public function setMetadata(?string $metadata): void;

    /**
     * Getter for StoreId.
     *
     * @return int|null
     */
    public function getStoreId(): ?int;

    /**
     * Setter for StoreId.
     *
     * @param int|null $storeId
     *
     * @return void
     */
    public function setStoreId(?int $storeId): void;
}
