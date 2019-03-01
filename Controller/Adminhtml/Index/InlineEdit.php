<?php

namespace Dungbv\Banner\Controller\Adminhtml\Index;


use Dungbv\Banner\Api\Data\BannerInterface;
use Dungbv\Banner\Model\BannerFactory;
use Dungbv\Banner\Model\BannerRepository;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;

class InlineEdit extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Dungbv_Banner::banner_manager';

    /**
     * @var $bannerRepository
     */
    protected $_bannerRepository;

    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $jsonFactory;

    protected $banner;
    /**
     * InlineEdit constructor.
     * @param Context $context
     * @param BannerRepository $bannerRepository
     * @param JsonFactory $jsonFactory
     */
    public function __construct(
        Context $context,
        BannerRepository $bannerRepository,
        BannerFactory $banner,
        JsonFactory $jsonFactory
    ) {
        parent::__construct($context);
        $this->_bannerRepository = $bannerRepository;
        $this->jsonFactory = $jsonFactory;
        $this->banner = $banner->create();
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];
        $postItems = $this->getRequest()->getParam('items', []);
        if ($this->getRequest()->getParam('isAjax')) {

            if (!count($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach ($postItems as $key=>$value) {
                    try {
                        $data = $this->_bannerRepository->getById($key);
                        $data->setData($value);
                        $this->_bannerRepository->save($data);
                    } catch (\Exception $e) {
                        $messages[] = 'không thể cập nhật banner';
                        $error = true;
                    }
                }
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }

    /**
     * Add block title to error message
     *
     * @param BannerInterface $block
     * @param string $errorText
     * @return string
     */
    protected function getErrorWithBannerkId(BannerInterface $block, $errorText)
    {
        return '[Banner ID: ' . $block->getId() . '] ' . $errorText;
    }
}