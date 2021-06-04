<?php
namespace Learning\FourthTask\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Department
 * @package Learning\FourthTask\Model\ResourceModel
 */
class Department extends AbstractDb
{

    protected function _construct()
    {
        /* tablename, primarykey*/
        $this->_init('Alex_department', 'id');
    }
}
