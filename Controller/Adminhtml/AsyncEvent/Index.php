<?php
declare(strict_types=1);

namespace MageOS\AsyncEventsAdminUi\Controller\Adminhtml\AsyncEvent;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

/**
 * AsyncEvent backend index (list) controller.
 */
class Index extends Action implements HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session.
     */
    public const ADMIN_RESOURCE = 'MageOS_AsyncEvents::async_events_create';

    /**
     * Execute action based on request and return result.
     *
     * @return ResultInterface|ResponseInterface
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $resultPage->setActiveMenu('MageOS_AsyncEvents::index');
        $resultPage->addBreadcrumb(__('AsyncEvent'), __('AsyncEvent'));
        $resultPage->addBreadcrumb(__('Manage AsyncEvents'), __('Manage AsyncEvents'));
        $resultPage->getConfig()->getTitle()->prepend(__('AsyncEvent List'));

        return $resultPage;
    }
}
