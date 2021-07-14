<?php
namespace Learning\TenthTask\Model\ResourceModel;


class ChangeName extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    )
    {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('product_change_title', 'product_id');
    }

}
