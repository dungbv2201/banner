<?php

namespace Dungbv\Banner\Controller\Adminhtml\Index;


use Dungbv\Banner\Model\BannerFactory;
use Dungbv\Banner\Model\BannerRepository;
use Dungbv\Banner\Model\ResourceModel\Banner\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;

class Save extends Action
{
    const ADMIN_RESOURCE = 'Dungbv_Banner::save';
    protected $_banner;
    protected $_collection;
    protected $_dataPersistor;
    protected $_bannerRepository;

    protected $_urlFolder = 'banner/images/';
    protected $_storeManager;

    public function __construct(
        \Dungbv\Banner\Model\BannerFactory $banner,
        StoreManagerInterface $storeManager,
        CollectionFactory $collectionFactory,
        BannerRepository $bannerRepository,
        DataPersistorInterface $dataPersistor,
        Action\Context $context)
    {
        $this->_banner           = $banner;
        $this->_storeManager     = $storeManager;
        $this->_bannerRepository = $bannerRepository;
        $this->_collection       = $collectionFactory->create();
        $this->_dataPersistor    = $dataPersistor;
        parent::__construct($context);
    }

    /**
     * @param array $rawData
     * @return array
     */
    protected function _filterBannerPostData(array $rawData): array
    {
        $data = $rawData;
        if (isset($data['image']) && is_array($data['image'])) {
            if (!empty($data['image']['delete'])) {
                $data['image'] = null;
            } else {
                if (isset($data['image'][0]['name']) && isset($data['image'][0]['tmp_name'])) {
                    $data['image'] = $data['image'][0]['name'];
                } else {
                    unset($data['image']);
                }
            }
        }
        return $data;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data           = $this->getRequest()->getPostValue();
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            if (empty($data['id'])) {
                $data['id'] = null;
            }
            $model = $this->_banner->create();
            $id    = $this->getRequest()->getParam('id');
            if ($id) {
                try {
                    $model = $this->_bannerRepository->getById($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This banner no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }

            $model->setData($this->_filterBannerPostData($data));
            try {
                $this->_bannerRepository->save($model);
//                if (file_exists($urlFile)){
//                    unlink($urlFile);
//                }
                $this->messageManager->addSuccessMessage(__('You saved the banner.'));
                $this->_dataPersistor->clear('banner');
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the banner.'));
            }

            $this->_dataPersistor->set('banner', $data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');

    }
}