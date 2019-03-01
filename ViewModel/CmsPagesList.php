<?php
//
//namespace Dungbv\Banner\ViewModel;
//
//
//use Dungbv\Banner\Model\Banner;
//use Magento\Framework\UrlInterface;
//use Magento\Framework\App\RequestInterface;
//use Magento\Framework\View\LayoutInterface;
//use Magento\Store\Model\StoreManagerInterface;
//use Magento\Framework\View\Element\Block\ArgumentInterface;
//use Dungbv\Banner\Model\ResourceModel\Banner\CollectionFactory;
//use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as CollectionProductFactory;
//
//
//class CmsPagesList implements ArgumentInterface
//{
//    protected $storeManagerInterface;
//    /**
//     * @var CollectionFactory
//     */
//    private   $collectionFactory;
//    protected $request;
//    protected $collectionProductFactory;
//    protected $layout;
//
//    /**
//     * CmsPagesList constructor.
//     * @param CollectionFactory $collectionFactory
//     */
//    public function __construct(
//        RequestInterface $request,
//        LayoutInterface $layout,
//        CollectionProductFactory $collectionProductFactory,
//        StoreManagerInterface $storeManager,
//        CollectionFactory $collectionFactory
//    )
//    {
//        $this->storeManagerInterface    = $storeManager;
//        $this->layout                   = $layout;
//        $this->request                  = $request;
//        $this->collectionFactory        = $collectionFactory;
//        $this->collectionProductFactory = $collectionProductFactory;
//    }
//
//    /**
//     * @return \Dungbv\Banner\Model\ResourceModel\Banner\Collection
//     */
//    public function getItems()
//    {
//        $collection = $this->collectionFactory->create();
//        $collection->setPageSize(Banner::PAGE_SIZE)->getData();
//        return $collection;
//    }
//
//    public function getCurrentPage()
//    {
//        return $this->request->getParam('p') ? $this->request->getParam('p') : 1;
//    }
//
//    public function getUrl()
//    {
//        return $this->storeManagerInterface->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA) . 'banner/images/';
//    }
//
//    public function getPager()
//    {
//        $layouts    = $this->layout;
//        $pager      = $layouts->get('blog_list_pager');
////        $collection = $this->getBlogList();
////        $pager->setAvailableLimit([2 => 2]);
////        $pager->setTotalNum($collection->getSize());
////        $pager->setCollection($collection);
////        $pager->setShowPager(true);
////        return $pager->toHtml();
//    }
//}