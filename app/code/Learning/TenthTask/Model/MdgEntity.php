<?php

namespace Learning\TenthTask\Model;

class MdgEntity extends \Magento\Framework\Model\AbstractModel implements \Learning\TenthTask\Api\Data\MdgEntityInterface
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

    public function getEntityId()
    {
        return $this->_getData(self::entityId);
    }

    public function getTitle()
    {
        return $this->_getData(self::title);

    }

    public function getCreatedDate()
    {
        return $this->_getData(self::createdDate);

    }

    public function getUpdatedDate()
    {
        return $this->_getData(self::updatedDate);
    }

    public function getStatus()
    {
        return $this->_getData(self::status);
    }

    public function getDescription()
    {
        return $this->_getData(self::description);
    }

    public function setTitle($title)
    {
        $this->setData(Self::title,$title);
    }

    public function setCreatedDate($createDate)
    {
        $this->setData(Self::createdDate,$createDate);
    }

    public function setUpdatedDate($updateDate)
    {
        $this->setData(Self::updatedDate,$updateDate);

    }

    public function setStatus($status)
    {
        $this->setData(Self::status,$status);

    }

    public function setDescription($description)
    {
        $this->setData(Self::description,$description);
    }

    public function setProductId($productId)
    {
        $this->setData(Self::productId,$productId);
    }
}
