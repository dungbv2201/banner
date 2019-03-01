<?php

namespace Dungbv\Banner\Controller\Adminhtml\Index;


use Dungbv\Banner\Api\BannerRepositoryInterface;
use Dungbv\Banner\Model\Banner;
use Dungbv\Banner\Model\BannerFactory;
use Magento\Backend\App\Action;

/**
 * Class Delete
 * @package Dungbv\Banner\Controller\Adminhtml\Index
 */
class Delete extends Action
{
    protected $banner;
    protected $repoBanner;

    /**
     * Delete constructor.
     * @param Action\Context $context
     * @param BannerFactory $banner
     * @param BannerRepositoryInterface $repoBanner
     */
    public function __construct(Action\Context $context, BannerFactory $banner, BannerRepositoryInterface $repoBanner)
    {
        $this->banner     = $banner;
        $this->repoBanner = $repoBanner;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            try {
                $this->repoBanner->deleteById($id);
                $this->messageManager->addSuccessMessage(__('You deleted the block.'));
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            }
            return $this->_redirect(Banner::URI_PATH_INDEX);
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a block to delete.'));
        // go to grid
        return $this->_redirect(Banner::URI_PATH_INDEX);
    }
}