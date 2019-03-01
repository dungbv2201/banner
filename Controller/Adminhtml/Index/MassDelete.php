<?php

namespace Dungbv\Banner\Controller\Adminhtml\Index;


use Dungbv\Banner\Model\Banner;
use Dungbv\Banner\Model\ResourceModel\Banner\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
//use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;

class MassDelete extends Action
{

    const ADMIN_RESOURCE = 'Dungbv_Banner::banner_manager';

    /**
     * @var Filter
     */
    protected $filter;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(Context $context, Filter $filter, CollectionFactory $collectionFactory)
    {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    /**
     * Execute action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @throws \Magento\Framework\Exception\LocalizedException|\Exception
     */
    public function execute()
    {
        $collections = $this->filter->getCollection($this->collectionFactory->create());
        $collectionSize = $collections->getSize();

        foreach ($collections as $banner) {
            $banner->delete();
        }

        $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been deleted.', $collectionSize));

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
//        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $this->_redirect(Banner::URI_PATH_INDEX);
    }
}