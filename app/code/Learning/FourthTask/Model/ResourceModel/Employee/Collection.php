<?php
namespace Learning\FourthTask\Model\ResourceModel\Employee;

use Magento\Eav\Model\Entity\Collection\AbstractCollection;

/**
 * Class Collection
 * @package Learning\FourthTask\Model\ResourceModel\Employee
 */
class Collection extends AbstractCollection
{
    protected function _construct()
    {
        /* Full model classname, full resource classname */
        $this->_init(
            'Learning\FourthTask\Model\Employee',
            'Learning\FourthTask\ResourceModel\Employee');
    }
}
