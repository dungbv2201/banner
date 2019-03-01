<?php

namespace Dungbv\Banner\Api;

interface BannerRepositoryInterface
{
    public function save(\Dungbv\Banner\Api\Data\BannerInterface $banner);

    public function getById($bannerId);

    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    public function deleteById($bannerId);

    public function delete(\Dungbv\Banner\Api\Data\BannerInterface $banner);

}