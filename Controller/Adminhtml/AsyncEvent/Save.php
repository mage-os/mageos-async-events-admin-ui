<?php
declare(strict_types=1);

namespace MageOS\AsyncEventsAdminUi\Controller\Adminhtml\AsyncEvent;

use MageOS\AsyncEventsAdminUi\Api\Data\AsyncEventInterface;
use MageOS\AsyncEventsAdminUi\Api\Data\AsyncEventInterfaceFactory;
use MageOS\AsyncEventsAdminUi\Command\AsyncEvent\SaveCommand;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\CouldNotSaveException;

/**
 * Save AsyncEvent controller action.
 */
class Save extends Action implements HttpPostActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    public const ADMIN_RESOURCE = 'MageOS_AsyncEvents::async_events_create';

    /**
     * @var DataPersistorInterface
     */
    private DataPersistorInterface $dataPersistor;

    /**
     * @var SaveCommand
     */
    private SaveCommand $saveCommand;

    /**
     * @var AsyncEventInterfaceFactory
     */
    private AsyncEventInterfaceFactory $entityDataFactory;

    /**
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param SaveCommand $saveCommand
     * @param AsyncEventInterfaceFactory $entityDataFactory
     */
    public function __construct(
        Context                    $context,
        DataPersistorInterface     $dataPersistor,
        SaveCommand                $saveCommand,
        AsyncEventInterfaceFactory $entityDataFactory
    )
    {
        parent::__construct($context);
        $this->dataPersistor = $dataPersistor;
        $this->saveCommand = $saveCommand;
        $this->entityDataFactory = $entityDataFactory;
    }

    /**
     * Save AsyncEvent Action.
     *
     * @return ResponseInterface|ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $params = $this->getRequest()->getParams();

        try {
            /** @var AsyncEventInterface|DataObject $entityModel */
            $entityModel = $this->entityDataFactory->create();
            $entityModel->addData($params['general']);
            $this->saveCommand->execute($entityModel);
            $this->messageManager->addSuccessMessage(
                __('The AsyncEvent data was saved successfully')
            );
            $this->dataPersistor->clear('entity');
        } catch (CouldNotSaveException $exception) {
            $this->messageManager->addErrorMessage($exception->getMessage());
            $this->dataPersistor->set('entity', $params);

            return $resultRedirect->setPath('*/*/edit', [
                AsyncEventInterface::SUBSCRIPTION_ID => $this->getRequest()->getParam(AsyncEventInterface::SUBSCRIPTION_ID)
            ]);
        }

        return $resultRedirect->setPath('*/*/');
    }
}
