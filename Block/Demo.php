<?php

namespace Dungbv\Banner\Block;

use Magento\Framework\View\Element\Template;

class Demo extends Template
{

    protected  function _prepareLayout()
    {
        $this->assign('data',$this->hello());
        return parent::_prepareLayout();
    }

    protected function hello(){
        return 'hello ace';
    }
}