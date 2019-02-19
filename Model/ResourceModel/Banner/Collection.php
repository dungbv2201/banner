<?php

namespace Dungbv\Banner\Model\ResourceModel\Banner;


use Dungbv\Banner\Model\Banner;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    protected $_idFieldName = 'id';

    protected function _construct()
    {
        $this->_init(Banner::class,\Dungbv\Banner\Model\ResourceModel\Banner::class);
    }
    /**
     * Add filter by store
     *
     * @param int|array|\Magento\Store\Model\Store $store
     * @param bool $withAdmin
     * @return $this
     */
}