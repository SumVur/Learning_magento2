<?php
namespace Learning\TenthTask\Model\ResourceModel\MdgEntity;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'entity_id';
    protected $_eventPrefix = 'entity_id_collection';
    protected $_eventObject = 'post_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Learning\TenthTask\Model\MdgEntity::class, \Learning\TenthTask\Model\ResourceModel\MdgEntity::class);
    }

}
