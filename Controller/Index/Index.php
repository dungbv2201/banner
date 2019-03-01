<?php

namespace Dungbv\Banner\Controller\Index;


use Dungbv\Banner\Model\Banner;
use Dungbv\Banner\Model\BannerFactory;
use Dungbv\Banner\Model\BannerRepository;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    protected $pageFactory;
    protected  $collection;
    public function __construct(Context $context,PageFactory $pageFactory,
                                \Dungbv\Banner\Model\ResourceModel\Banner\CollectionFactory $collection)
    {
        $this->pageFactory = $pageFactory;

        $this->collection = $collection;
        parent::__construct($context);
    }

    public function execute()
    {
        $co = $this->collection->create();
//        $data =$co->init(Banner::class,\Dungbv\Banner\Model\ResourceModel\Banner::class)
//            ->addFieldToSelect('*')->getData();

       return $this->pageFactory->create();
    }
}