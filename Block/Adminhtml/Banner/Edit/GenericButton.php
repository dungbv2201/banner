<?php

namespace Dungbv\Banner\Block\Adminhtml\Banner\Edit;

use Dungbv\Banner\Api\BannerRepositoryInterface;
use Magento\Backend\Block\Widget\Context;
use Dungbv\Banner\Model\ResourceModel\Banner\CollectionFactory;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class GenericButton
 */
class GenericButton
{
    /**
     * @var Context
     */
    protected $context;
    protected $_collectionFactory;
    protected $_bannerRepository;

    public function __construct(
        CollectionFactory $collection,
        Context $context,
        BannerRepositoryInterface $bannerRepository
    )
    {
        $this->_collectionFactory = $collection->create();
        $this->context            = $context;
        $this->_bannerRepository  = $bannerRepository;
    }


    public function getBannerId()
    {
        try {
            return $this->_bannerRepository->getById(
                $this->context->getRequest()->getParam('id')
            )->getId();
        } catch (NoSuchEntityException $e) {
        }

        return null;
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
