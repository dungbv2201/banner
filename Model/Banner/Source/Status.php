<?php
namespace Dungbv\Banner\Model\Banner\Source;

use Dungbv\Banner\Model\Banner;
use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class Status
 */
class Status implements OptionSourceInterface
{
    /**
     * @var \Dungbv\Banner\Model\Banner $banner
     */
    protected $banner;

    /**
     * Constructor
     *
     * @param \Dungbv\Banner\Model\Banner $banner
     */
    public function __construct(Banner $banner)
    {
        $this->banner = $banner;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $availableOptions = $this->banner->getAvailableStatuses();
        $options = [];
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}
