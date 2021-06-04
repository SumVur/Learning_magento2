<?php

namespace Learning\FourthTask\Model\ResourceModel\Department;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package Learning\FourthTask\Model\ResourceModel\Department
 */
class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Learning\FourthTask\Model\Department', 'Learning\FourthTask\Model\ResourceModel\Department');
    }
}
