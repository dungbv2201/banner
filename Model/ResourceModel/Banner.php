<?php

namespace Dungbv\Banner\Model\ResourceModel;

use Magento\Framework\App\ObjectManager;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;


class Banner extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('banner','id');
    }

    protected function _afterSave(\Magento\Framework\Model\AbstractModel $object)
    {
        $image = $object->getData('image');
        if($image != null){
            $imageUpload = ObjectManager::getInstance()->create('Dungbv\Banner\IndexImageUpload');
            $imageUpload->moveFileFromTmp($image);
        }
    }
}