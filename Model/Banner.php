<?php

namespace Dungbv\Banner\Model;


use Dungbv\Banner\Api\Data\BannerInterface;
use Magento\Framework\Model\AbstractModel;

/**
 * Class Banner
 * @package Dungbv\Banner\Model
 */
class Banner extends AbstractModel implements BannerInterface
{
    const  STATUS_ENABLED  = 1;
    const  STATUS_DISABLED = 0;
    const  NOROUTE_PAGE_ID = 'no-route';
    const  PAGE_SIZE        = 3;
    const BASE_PATH_IMAGE = 'banner/images/';

    protected function _construct()
    {
        $this->_init(\Dungbv\Banner\Model\ResourceModel\Banner::class);
    }

//    public function load($id, $field = null)
//    {
//        if ($id === null) {
//            return $this->noRoutePage();
//        }
//        return parent::load($id, $field);
//    }
//
//    public function noRoutePage()
//    {
//        return $this->load(self::NOROUTE_PAGE_ID, $this->getIdFieldName());
//    }
//
//    public function getStores()
//    {
//        return $this->hasData('stores') ? $this->getData('stores') : (array)$this->getData('store_id');
//    }

    public function getAvailableStatuses()
    {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }

    public function getId()
    {
        return $this->getData(self::BANNER_ID);
    }

    public function name()
    {
        return ['dsd','dsd'];
    }

    /**
     * Get title
     *
     * @return string|null
     */
    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    /**
     * Get content
     *
     * @return string|null
     */
    public function getContent()
    {
        return $this->getData(self::CONTENT);
    }

    /**
     * status
     *
     * @return 0|1
     */
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return BannerInterface
     */
    public function setId($id)
    {
        return $this->setData(self::BANNER_ID, $id);
    }

    /**
     * Set title
     *
     * @param string $title
     * @return BannerInterface
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * Set content
     *
     * @param string $content
     * @return BannerInterface
     */
    public function setContent($content)
    {
        return $this->setData(self::CONTENT, $content);
    }

    /**
     * Set status
     *
     * @param bool|int $isActive
     * @return BannerInterface
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }
}