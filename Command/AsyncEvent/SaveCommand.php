<?php
declare(strict_types=1);

namespace MageOS\AsyncEventsAdminUi\Command\AsyncEvent;

use Exception;
use MageOS\AsyncEventsAdminUi\Api\Data\AsyncEventInterface;
use MageOS\AsyncEventsAdminUi\Model\AsyncEventModel;
use MageOS\AsyncEventsAdminUi\Model\AsyncEventModelFactory;
use MageOS\AsyncEventsAdminUi\Model\ResourceModel\AsyncEventResource;
use Magento\Framework\Exception\CouldNotSaveException;
use Psr\Log\LoggerInterface;

/**
 * Save AsyncEvent Command.
 */
class SaveCommand
{
    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @var AsyncEventModelFactory
     */
    private AsyncEventModelFactory $modelFactory;

    /**
     * @var AsyncEventResource
     */
    private AsyncEventResource $resource;

    /**
     * @param LoggerInterface $logger
     * @param AsyncEventModelFactory $modelFactory
     * @param AsyncEventResource $resource
     */
    public function __construct(
        LoggerInterface        $logger,
        AsyncEventModelFactory $modelFactory,
        AsyncEventResource     $resource
    )
    {
        $this->logger = $logger;
        $this->modelFactory = $modelFactory;
        $this->resource = $resource;
    }

    /**
     * Save AsyncEvent.
     *
     * @param AsyncEventInterface $asyncEvent
     *
     * @return int
     * @throws CouldNotSaveException
     */
    public function execute(AsyncEventInterface $asyncEvent): int
    {
        try {
            /** @var AsyncEventModel $model */
            $model = $this->modelFactory->create();
            $model->addData($asyncEvent->getData());
            $model->setHasDataChanges(true);

            if (!$model->getData(AsyncEventInterface::SUBSCRIPTION_ID)) {
                $model->isObjectNew(true);
            }
            $this->resource->save($model);
        } catch (Exception $exception) {
            $this->logger->error(
                __('Could not save AsyncEvent. Original message: {message}'),
                [
                    'message' => $exception->getMessage(),
                    'exception' => $exception
                ]
            );
            throw new CouldNotSaveException(__('Could not save AsyncEvent.'));
        }

        return (int)$model->getData(AsyncEventInterface::SUBSCRIPTION_ID);
    }
}
