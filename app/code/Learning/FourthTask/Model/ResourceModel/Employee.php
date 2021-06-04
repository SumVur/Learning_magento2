<?php
namespace Learning\FourthTask\Model\ResourceModel;

use Magento\Eav\Model\Entity\AbstractEntity;

/**
 * Class Employee
 * @package Learning\FourthTask\Model\ResourceModel
 */
class Employee extends AbstractEntity {
    protected function _construct() {
        $this->_read = 'Alex_employee_read';
        $this->_write = 'Alex_employee_write';
    }

    /**
     * @return \Magento\Eav\Model\Entity\Type
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getEntityType() :\Magento\Eav\Model\Entity\Type
    {
        if(empty($this->_type))
        {
            $this->setType(\Learning\FourthTask\Model\Employee::ENTITY);
        }

        return parent::getEntityType();
    }
}
