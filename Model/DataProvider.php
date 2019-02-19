<?php

namespace Dungbv\Banner\Model;

use Dungbv\Banner\Model\ResourceModel\Banner\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;

class DataProvider extends AbstractDataProvider
{
    protected $_loadedData;

    protected $_dataPersistor;

    protected $_storeManager;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $employeeCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $bannerCollectionFactory,
        DataPersistorInterface $dataPersistor,
        StoreManagerInterface $storeManager,
        array $meta = [],
        array $data = []
    )
    {
        $this->collection     = $bannerCollectionFactory->create();
        $this->_dataPersistor = $dataPersistor;
        $this->_storeManager  = $storeManager;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->_loadedData)) {
            return $this->_loadedData;
        }
        $items = $this->collection->getItems();

        /**
         * @var \Dungbv\Banner\Model\Banner $banner
         */
        foreach ($items as $banner) {
            $data      = $banner->getData();
            $imageName = $data['image'];
            unset($data['image']);
            $data['image'][0]['url']  = $this->_storeManager
                    ->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA) . 'banner/images/' . $imageName;
            $data['image'][0]['name'] = $imageName;

            $this->_loadedData[$banner->getId()] = $data;

        }

        $data = $this->_dataPersistor->get('banner');
        if (!empty($data)) {
            $banner = $this->collection->getNewEmptyItem();
            $banner->setData($data);
            $this->_loadedData[$banner->getData('id')] = $banner->getData();
            $this->_dataPersistor->clear('banner');
        }

        return $this->_loadedData;
    }
}