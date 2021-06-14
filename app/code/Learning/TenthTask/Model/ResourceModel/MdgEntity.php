<?php
namespace Learning\TenthTask\Model\ResourceModel;


class MdgEntity extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    )
    {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('mdg_entity', 'entity_id');
    }

}
