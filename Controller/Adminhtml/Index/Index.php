<?php

namespace Dungbv\Banner\Controller\Adminhtml\Index;


use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 * @package Dungbv\Banner\Controller\Adminhtml\Index
 */
class Index extends Action
{
    const ADMIN_RESOURCE = 'Dungbv_Banner::banner_manager';

    protected $_pageFactory;

    /**
     * Index constructor.
     * @param Action\Context $context
     * @param PageFactory $pageFactory
     */
    public function __construct(Action\Context $context, PageFactory $pageFactory)
    {
        $this->_pageFactory = $pageFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->_pageFactory->create();
        $this->_setActiveMenu('Dungbv_Banner::banner');
        $resultPage->getConfig()->getTitle()->prepend(__('List All Banner'));
        return $resultPage;
    }
}