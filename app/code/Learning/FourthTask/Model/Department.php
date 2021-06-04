<?php

namespace Learning\FourthTask\Model;

use Magento\Framework\Model\AbstractModel;

/**
 * Class Department
 * @package Learning\FourthTask\Model
 */
class Department extends AbstractModel
{
    protected function _construct()
    {
        /* full resource classname */
        $this->_init('Learning\FourthTask\Model\ResourceModel\Department');
    }
}
