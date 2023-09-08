<?php
declare(strict_types=1);

namespace MageOS\AsyncEventsAdminUi\Controller\Adminhtml\AsyncEvent;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

/**
 * Edit AsyncEvent entity backend controller.
 */
class Edit extends Action implements HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session.
     *
     * @see _isAllowed()
     */
    public const ADMIN_RESOURCE = 'MageOS_AsyncEvents::async_events_create';

    /**
     * Edit AsyncEvent action.
     *
     * @return Page|ResultInterface
     */
    public function execute()
    {
        /** @var Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('MageOS_AsyncEvents::index');
        $resultPage->getConfig()->getTitle()->prepend(__('Edit AsyncEvent'));

        return $resultPage;
    }
}
