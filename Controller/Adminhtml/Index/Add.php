<?php

namespace Dungbv\Banner\Controller\Adminhtml\Index;


use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;


class Add extends Action
{
    const ADMIN_RESOURCE = 'Dungbv_Banner::save';
    protected $_pageFactory;
    protected $_banner;
    protected $_storeManager;

    public function __construct(Action\Context $context, PageFactory $pageFactory)
    {
        $this->_pageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $this->_forward('edit');

    }

}