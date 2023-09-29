<?php
declare(strict_types=1);

namespace MageOS\AsyncEventsAdminUi\Command\AsyncEvent;

use Exception;
use Magento\Framework\Encryption\EncryptorInterface;
use MageOS\AsyncEvents\Api\Data\AsyncEventInterface;
use MageOS\AsyncEvents\Model\ResourceModel\AsyncEvent as AsyncEventResource;
use Magento\Framework\Exception\CouldNotSaveException;
use Psr\Log\LoggerInterface;

/**
 * Save AsyncEvent Command.
 */
class SaveCommand
{
    public function __construct(
        private readonly LoggerInterface    $logger,
        private readonly AsyncEventResource $resource,
        private readonly EncryptorInterface $encryptor
    ) {
    }

    /**
     * Save AsyncEvent.
     *
     * @throws CouldNotSaveException
     */
    public function execute(AsyncEventInterface $asyncEvent): int
    {
        try {
            $asyncEvent->setHasDataChanges(true);

            if (!$asyncEvent->getSubscriptionId()) {
                $asyncEvent->isObjectNew(true);
                $asyncEvent->setSubscribedAt((new \DateTime())->format(\DateTimeInterface::ATOM));
                $secretVerificationToken = $this->encryptor->encrypt($asyncEvent->getVerificationToken());
                $asyncEvent->setVerificationToken($secretVerificationToken);
            }
            $this->resource->save($asyncEvent);
        } catch (Exception $exception) {
            $this->logger->error(
                __('Could not save Asynchronous Event Subscriber. Original message: {message}'),
                [
                    'message' => $exception->getMessage(),
                    'exception' => $exception
                ]
            );
            throw new CouldNotSaveException(__('Could not save Asynchronous Event Subscriber.'));
        }

        return (int)$asyncEvent->getSubscriptionId();
    }
}
