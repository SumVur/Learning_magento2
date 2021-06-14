<?php
namespace Learning\TenthTask\Model;

class MdgEntity extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'Learning_TenthTask_mdg_entity_post';

    protected $_cacheTag = 'Learning_TenthTask_mdg_entity_post';

    protected $_eventPrefix = 'Learning_TenthTask_mdg_entity_post';

    protected function _construct()
    {
        $this->_init('Learning\TenthTask\Model\ResourceModel\MdgEntity');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}
