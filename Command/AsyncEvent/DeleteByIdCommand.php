<?php
declare(strict_types=1);

namespace MageOS\AsyncEventsAdminUi\Command\AsyncEvent;

use Exception;
use MageOS\AsyncEvents\Model\AsyncEvent as AsyncEventModel;
use MageOS\AsyncEvents\Model\AsyncEventFactory as AsyncEventModelFactory;
use MageOS\AsyncEvents\Model\ResourceModel\AsyncEvent as AsyncEventResource;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Psr\Log\LoggerInterface;

/**
 * Delete AsyncEvent by id Command.
 */
class DeleteByIdCommand
{
    private LoggerInterface $logger;
    private AsyncEventModelFactory $modelFactory;
    private AsyncEventResource $resource;

    public function __construct(
        LoggerInterface        $logger,
        AsyncEventModelFactory $modelFactory,
        AsyncEventResource     $resource
    ) {
        $this->logger = $logger;
        $this->modelFactory = $modelFactory;
        $this->resource = $resource;
    }

    /**
     * Delete AsyncEvent.
     *
     * @throws CouldNotDeleteException
     */
    public function execute(int $entityId): void
    {
        try {
            /** @var AsyncEventModel $model */
            $model = $this->modelFactory->create();
            $this->resource->load($model, $entityId);

            if (!$model->getSubscriptionId()) {
                throw new NoSuchEntityException(
                    __(
                        'Could not find Asynchronous Event Subscriber with id: `%subscription_id`',
                        [
                            'subscription_id' => $entityId
                        ]
                    )
                );
            }

            $this->resource->delete($model);
        } catch (Exception $exception) {
            $this->logger->error(
                __('Could not delete Asynchronous Event Subscriber. Original message: {message}'),
                [
                    'message' => $exception->getMessage(),
                    'exception' => $exception
                ]
            );
            throw new CouldNotDeleteException(__('Could not delete Asynchronous Event Subscriber.'));
        }
    }
}
