<?php

namespace Dungbv\Banner\Controller\Adminhtml\Index;

use Dungbv\Banner\Model\BannerRepositoryFactory;
use Dungbv\Banner\Model\ResourceModel\Banner\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Framework\Api\Filter;
use Magento\Framework\Api\Search\FilterGroup;
use Magento\Framework\Api\Search\SearchCriteria;
use Magento\Framework\App\ResourceConnection;
use Zend\Http\Client;
use Zend\I18n\Filter\Alnum;
use Zend\Validator\StringLength;
use Zend_Db_Expr;


class Test extends Action
{
    protected $collection;
    protected $bannerRepo;

    public function __construct(Action\Context $context, BannerRepositoryFactory $bannerRepo, CollectionFactory $collectionFactory)
    {
        $this->collection = $collectionFactory;
        $this->bannerRepo = $bannerRepo;
        parent::__construct($context);
    }

    protected function filter(string $field, string $condition, string $value)
    {
        $filter = $this->_objectManager->create(Filter::class);
        $filter->setField($field)
            ->setConditionType($condition)
            ->setValue($value);
        return $filter;
    }

    public function execute()
    {
//        $uri = 'http://127.0.0.1/magento2.2.6/rest/V1/banner/name';
//        $httpClient = new \Zend\Http\Client();
//        $httpClient->setUri($uri);
//        $httpClient->setOptions(array(
//            'timeout' => 30
//        ));
//        try {
//            echo $httpClient->send()->getBody();die;
//
//        } catch (\Exception $e) {
//
//        }
//        $collections = $this->collection->create();
//      echo "<pre>";
//      var_dump($collections->getData());
//      echo "</pre>";
//      die;
        // $this->_objectManager->create('Dungbv\Banner\Controller\Adminhtml\Index\Hello\Proxy')->helloWorld();

        // $object = $this->_objectManager->create('Dungbv\Banner\Controller\Adminhtml\Index\Hello\Proxy');
        //        $object->helloWorld();

//        $filter       = $this->filter('title', 'like', 'ban%');
//
//        $filter_group = $this->_objectManager->create(FilterGroup::class);
//        $filter_group->setFilters([$filter]);
//
//        $search_criteria = $this->_objectManager->create(SearchCriteria::class);
//        $search_criteria->setFilterGroups([$filter_group]);
//        $banners = $this->bannerRepo->create()->getList($search_criteria)->getItems();
//        foreach ($banners as $banner){
//            echo $banner['title'];
//        }
//
        $v = new StringLength();
        $st = ['ew'];
        if($v->isValid($st)){
            echo 'dung';
        }else{
            foreach ($v->getMessages() as $m){
                echo $m;
            }
        }
        die;
        $filter = new Alnum();
        echo "<pre>";
        var_dump($filter->filter('abc @#$@$ 12123dasf3'));
        echo "</pre>";
        die;
        $bannerCollection = $this->collection->create();
        $a = $bannerCollection->addFieldToSelect('id')->addExpressionFieldToSelect('tieu_de','title
        ','')
            ->getData();
        echo "<pre>";
             print_r($a);
        echo "</pre>";
        die;
    }

}