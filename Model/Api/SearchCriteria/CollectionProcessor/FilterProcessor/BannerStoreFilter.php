<?php

namespace Dungbv\Banner\Model\Api\SearchCriteria\CollectionProcessor\FilterProcessor;


use Magento\Framework\Api\Filter;
use Magento\Framework\Api\SearchCriteria\CollectionProcessor\FilterProcessor\CustomFilterInterface;
use Magento\Framework\Data\Collection\AbstractDb;


class BannerStoreFilter implements CustomFilterInterface
{
    /**
     * Apply custom store filter to collection
     *
     * @param Filter $filter
     * @param AbstractDb $collection
     * @return bool
     */
    public function apply(Filter $filter, AbstractDb $collection)
    {

        $collection->addStoreFilter($filter->getValue(), false);

        return true;
    }
}