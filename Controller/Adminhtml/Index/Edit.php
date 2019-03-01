<?php

namespace Dungbv\Banner\Controller\Adminhtml\Index;


use Magento\Backend\App\Action;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Dungbv\Banner\Model\BannerFactory;
use Dungbv\Banner\Model\BannerRepository;

class Edit extends Action
{
    const ADMIN_RESOURCE = 'Dungbv_Banner::save';
    /**
     * @var PageFactory
     */
    protected $_pageFactory;
    /**
     * @var BannerRepository
     */
    protected $_bannerRepo;
    /**
     * @var BannerFactory
     */
    protected $_banner;
    /**
     * @var string $title
     */
    protected $_title = 'Add New Banner';
    protected $_registry;

    public function __construct(Action\Context $context,
                                PageFactory $pageFactory,
                                BannerFactory $banner,
                                BannerRepository $bannerRepo,
                                Registry $registry
    )
    {
        $this->_banner      = $banner;
        $this->_bannerRepo  = $bannerRepo;
        $this->_pageFactory = $pageFactory;
        $this->_registry    = $registry;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->_pageFactory->create();
        $id         = $this->getRequest()->getParam('id');
        if ($id) {
            try {
                $this->_bannerRepo->getById($id);
                $this->_title ='Edit banner';
            } catch (LocalizedException $exception) {
                $this->getMessageManager()->addErrorMessage(__('This banner no longer exists.'));
                return $this->_redirect('*/*/');
            }
        }
        $this->_setActiveMenu("Dungbv_Banner::banner");
        $resultPage->getConfig()->getTitle()->prepend(__($this->_title));
        return $resultPage;
    }

}