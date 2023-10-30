<?php
declare(strict_types=1);

namespace MageOS\AsyncEventsAdminUi\Controller\Adminhtml\Events;

use MageOS\AsyncEvents\Api\Data\AsyncEventInterface;
use MageOS\AsyncEvents\Api\Data\AsyncEventInterfaceFactory;
use MageOS\AsyncEventsAdminUi\Command\AsyncEvent\SaveCommand;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
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

    private DataPersistorInterface $dataPersistor;
    private SaveCommand $saveCommand;
    private AsyncEventInterfaceFactory $asyncEventFactory;

    public function __construct(
        Context                    $context,
        DataPersistorInterface     $dataPersistor,
        SaveCommand                $saveCommand,
        AsyncEventInterfaceFactory $entityDataFactory
    ) {
        parent::__construct($context);
        $this->dataPersistor = $dataPersistor;
        $this->saveCommand = $saveCommand;
        $this->asyncEventFactory = $entityDataFactory;
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
        if (isset($params['general'])) {
            $params = $params['general'];
        }
        if ($params['subscription_id'] === '') {
            unset($params['subscription_id']);
        }

        try {
            /** @var AsyncEventInterface $entityModel */
            $entityModel = $this->asyncEventFactory->create();
            $entityModel->addData($params);
            $this->saveCommand->execute($entityModel);
            $this->messageManager->addSuccessMessage(
                __('The Asynchronous Event Subscriber data was saved successfully')
            );
            $this->dataPersistor->clear('entity');
        } catch (CouldNotSaveException $exception) {
            $this->messageManager->addErrorMessage($exception->getMessage());
            $this->dataPersistor->set('entity', $params);

            return $resultRedirect->setPath('*/*/edit', [
                'subscription_id' => $this->getRequest()->getParam('subscription_id')
            ]);
        }

        return $resultRedirect->setPath('*/*/');
    }
}
