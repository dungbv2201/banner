<?php

namespace Dungbv\Banner\Controller\Adminhtml\Index;


use Magento\Backend\App\Action;



/**
 * Class Add
 * @package Dungbv\Banner\Controller\Adminhtml\Index
 */
class Add extends Action
{
    const ADMIN_RESOURCE = 'Dungbv_Banner::save';
    protected $_banner;
    protected $_storeManager;

    /**
     * Add constructor.
     * @param Action\Context $context
     *
     */
    public function __construct(Action\Context $context)
    {
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        $this->_forward('edit');

    }

}