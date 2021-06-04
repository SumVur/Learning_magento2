<?php
namespace Learning\FourthTask\Model;

use Magento\Framework\Model\AbstractModel;

/**
 * Class Employee
 * @package Learning\FourthTask\Model
 */
class Employee extends AbstractModel
{
    /**
     * ENTITY name
     */
    const ENTITY = 'Alex_employee';

    protected function _construct()
    {
        /* full resource classname */
        $this->_init('Learning\FourthTask\Model\ResourceModel\Employee');
    }
}
