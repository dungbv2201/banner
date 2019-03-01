<?php

namespace Dungbv\Banner\Model\ResourceModel;


use Dungbv\Banner\Helper\Validation;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;


/**
 * Class Banner
 * @package Dungbv\Banner\Model\ResourceModel
 */
class Banner extends AbstractDb
{

    protected $validator;
    protected $urlInterface;
    protected $storeManager;
    public function __construct(\Magento\Framework\Model\ResourceModel\Db\Context $context,
                                Validation $validation,UrlInterface $url,StoreManagerInterface $storeManager,
                                string $connectionName = null
    )
    {
        $this->validator = $validation;
        $this->urlInterface = $url;
        $this->storeManager =  $storeManager;
        parent::__construct($context, $connectionName);
    }

    protected function _construct()
    {
        $this->_init('banner','id');
    }


    /**
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return AbstractDb|void
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _afterSave(\Magento\Framework\Model\AbstractModel $object)
    {
        $image = $object->getData('image');
        if($image != null){
            $imageUpload = ObjectManager::getInstance()->create('Dungbv\Banner\IndexImageUpload');
            $imageUpload->moveFileFromTmp($image);
        }
    }

    protected function _beforeSave(\Magento\Framework\Model\AbstractModel $object)
    {
//        $this->urlInterface->getBaseUrl()
    }

    /**
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return AbstractDb
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    protected function _afterDelete(\Magento\Framework\Model\AbstractModel $object)
    {
        $path_file = 'pub/media/'.\Dungbv\Banner\Model\Banner::BASE_PATH_IMAGE. $object->getData('image');
        if(file_exists($path_file)){
            unlink($path_file);
        }
        return parent::_afterDelete($object);
    }
}