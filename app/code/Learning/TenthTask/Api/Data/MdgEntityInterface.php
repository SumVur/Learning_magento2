<?php

namespace Learning\TenthTask\Api\Data;


interface MdgEntityInterface extends \Magento\Framework\DataObject\IdentityInterface
{

    const entityId = "entity_id";
    const title = "title";
    const createdDate = "created_at";
    const updatedDate = "updated_at";
    const productId = "product_id";
    const status = "status";
    const description = "description";

    public function getEntityId();

    public function getTitle();

    public function getCreatedDate();

    public function getUpdatedDate();

    public function getStatus();

    public function getDescription();


    public function setTitle($title);

    public function setCreatedDate($createDate);

    public function setUpdatedDate($updateDate);

    public function setStatus($status);

    public function setDescription($description);

}
