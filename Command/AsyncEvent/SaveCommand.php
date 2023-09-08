<?php
declare(strict_types=1);

namespace MageOS\AsyncEventsAdminUi\Command\AsyncEvent;

use Exception;
use MageOS\AsyncEvents\Api\Data\AsyncEventInterface;
use MageOS\AsyncEvents\Model\AsyncEvent as AsyncEventModel;
use MageOS\AsyncEvents\Model\AsyncEventFactory as AsyncEventModelFactory;
use MageOS\AsyncEvents\Model\ResourceModel\AsyncEvent as AsyncEventResource;
use Magento\Framework\Exception\CouldNotSaveException;
use Psr\Log\LoggerInterface;

/**
 * Save AsyncEvent Command.
 */
class SaveCommand
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
     * Save AsyncEvent.
     *
     * @throws CouldNotSaveException
     */
    public function execute(AsyncEventInterface $asyncEvent): int
    {
        try {
            /** @var AsyncEventModel $model */
            $model = $this->modelFactory->create();
            $model->addData($asyncEvent->getData());
            $model->setHasDataChanges(true);

            if (!$model->getSubscriptionId()) {
                $model->isObjectNew(true);
            }
            $this->resource->save($model);
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

        return (int)$model->getSubscriptionId();
    }
}
