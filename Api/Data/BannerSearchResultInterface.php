<?php
namespace Dungbv\Banner\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface BannerSearchResultInterface extends SearchResultsInterface
{
    /**
     * Get banners list.
     *
     * @return \Dungbv\Banner\Api\Data\BannerInterface[]
     */
    public function getItems();

    /**
     * Set banners list.
     *
     * @param \Dungbv\Banner\Api\Data\BannerInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}