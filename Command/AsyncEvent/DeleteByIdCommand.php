<?php
declare(strict_types=1);

namespace MageOS\AsyncEventsAdminUi\Command\AsyncEvent;

use Exception;
use MageOS\AsyncEventsAdminUi\Api\Data\AsyncEventInterface;
use MageOS\AsyncEventsAdminUi\Model\AsyncEventModel;
use MageOS\AsyncEventsAdminUi\Model\AsyncEventModelFactory;
use MageOS\AsyncEventsAdminUi\Model\ResourceModel\AsyncEventResource;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Psr\Log\LoggerInterface;

/**
 * Delete AsyncEvent by id Command.
 */
class DeleteByIdCommand
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
     * Delete AsyncEvent.
     *
     * @param int $entityId
     *
     * @return void
     * @throws CouldNotDeleteException
     */
    public function execute(int $entityId): void
    {
        try {
            /** @var AsyncEventModel $model */
            $model = $this->modelFactory->create();
            $this->resource->load($model, $entityId, AsyncEventInterface::SUBSCRIPTION_ID);

            if (!$model->getData(AsyncEventInterface::SUBSCRIPTION_ID)) {
                throw new NoSuchEntityException(
                    __('Could not find AsyncEvent with id: `%id`',
                        [
                            'id' => $entityId
                        ]
                    )
                );
            }

            $this->resource->delete($model);
        } catch (Exception $exception) {
            $this->logger->error(
                __('Could not delete AsyncEvent. Original message: {message}'),
                [
                    'message' => $exception->getMessage(),
                    'exception' => $exception
                ]
            );
            throw new CouldNotDeleteException(__('Could not delete AsyncEvent.'));
        }
    }
}
