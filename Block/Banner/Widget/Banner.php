<?php

namespace Dungbv\Banner\Block\Banner\Widget;

use Dungbv\Banner\Model\ResourceModel\Banner\CollectionFactory;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Template;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Widget\Block\BlockInterface;

class Banner extends Template implements BlockInterface
{
    protected $_collection;
    protected $_storeManager;

    public function __construct(
        Context $context,
        StoreManagerInterface $storeManager,
        CollectionFactory $bannerCollectionFactory,
        array $data = []
    )
    {
        $this->_collection   = $bannerCollectionFactory;
        $this->_storeManager = $storeManager;
        $this->setTemplate('widget.phtml');
        parent::__construct(
            $context,
            $data
        );
    }

    protected function _beforeToHtml()
    {
        $collection = $this->_collection->create();
        $banners    = $collection->addFieldToFilter('status', ['eq' => true])->getData();
        $urlMedia = $this->_storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA ). 'banner/images/';
        $this->setData('banner', $banners);
        $this->setData('urlMedia',$urlMedia);
        return parent::_beforeToHtml();
    }

}
