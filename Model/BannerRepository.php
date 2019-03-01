<?php

namespace Dungbv\Banner\Model;


use Dungbv\Banner\Api\BannerRepositoryInterface;
use Dungbv\Banner\Api\Data\BannerInterface;
use Dungbv\Banner\Api\Data\BannerSearchResultInterfaceFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\StoreManagerInterface;
use Dungbv\Banner\Model\ResourceModel\Banner as ResourceBanner;

class BannerRepository implements BannerRepositoryInterface
{
    protected $_storeManager;
    protected $_resource;
    protected $_bannerFactory;
    protected $bannerCollectionFactory;
    protected $collectionProcessor;
    protected $searchResultsFactory;


    public function __construct(StoreManagerInterface $storeManager,
                                ResourceBanner $resource,
                                BannerFactory $bannerFactory,
                                CollectionProcessorInterface $collectionProcessor,
                                BannerSearchResultInterfaceFactory $searchResultsFactory,
                                ResourceBanner\CollectionFactory $collection)
    {
        $this->_storeManager           = $storeManager;
        $this->_resource               = $resource;
        $this->_bannerFactory          = $bannerFactory;
        $this->bannerCollectionFactory = $collection;
        $this->collectionProcessor     = $collectionProcessor;
        $this->searchResultsFactory    = $searchResultsFactory;
    }

    public function save(BannerInterface $banner)
    {
        //        if (empty($banner->getStoreId())) {
        //            $storeId = $this->_storeManager->getStore()->getId();
        //            $banner->setStoreId($storeId);
        //        }
        try {
            $this->_resource->save($banner);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the banner: %1', $exception->getMessage()),
                $exception
            );
        }
        return $banner;

    }

    public function getById($bannerId)
    {
        $banner = $this->_bannerFactory->create();
        $banner->load($bannerId);
        if (!$banner->getId()) {
            throw new NoSuchEntityException(__('Banner with id "%1" does not exist.', $bannerId));
        }
        return $banner;

    }

    public function deleteById($bannerId)
    {
        return $this->delete($this->getById($bannerId));
    }

    public function delete(BannerInterface $banner)
    {
        try {
            $this->_resource->delete($banner);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the banner: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $criteria)
    {

        $collection = $this->bannerCollectionFactory->create();

        $this->collectionProcessor->process($criteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * Retrieve collection processor
     *
     * @deprecated 101.1.0
     * @return CollectionProcessorInterface
     */
//    private function getCollectionProcessor()
//    {
//        if (!$this->collectionProcessor) {
//            $this->collectionProcessor = \Magento\Framework\App\ObjectManager::getInstance()->get(
//                'Dungbv\Banner\Model\Api\SearchCriteria\BannerCollectionProcessor'
//            );
//        }
//        return $this->collectionProcessor;
//    }
}