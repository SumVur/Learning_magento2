<?php

namespace Learning\TenthTask\Model;

use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\NoSuchEntityException;
use mysql_xdevapi\Exception;
use Prophecy\Exception\Doubler\ClassCreatorException;

/**
 * Class MdgEntityRepository
 * @package Learning\TenthTask\Model
 */
class MdgEntityRepository implements \Learning\TenthTask\Api\MdgEntityRepositoryInterface
{
    private \Learning\TenthTask\Model\MdgEntityFactory $MdgEntityFactory;

    /**
     * @var ResourceModel\ChangeName
     */
    private $resource;

    /**
     * @var ResourceModel\MdgEntity\CollectionFactory
     */
    private $collectionFactory;

    public function __construct(
        \Learning\TenthTask\Model\MdgEntityFactory $MdgEntityFactory,
        \Learning\TenthTask\Model\ResourceModel\MdgEntity $resource,
        \Learning\TenthTask\Model\ResourceModel\MdgEntity\CollectionFactory  $collectionFactory
    )
    {
        $this->MdgEntityFactory = $MdgEntityFactory;
        $this->resource = $resource;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @return MdgEntity
     */
    public function create()
    {
            return $this->MdgEntityFactory->create();
    }

    /**
     * @param \Learning\TenthTask\Model\MdgEntity $entity
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function save($entity)
    {
        try {
            $this->resource->save($entity);
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            die();
        }

        return $entity;
    }

    /**
     * @param $id
     * @return MdgEntity
     * @throws NoSuchEntityException
     */
    public function getById($id)
    {
        $MdgEntity = $this->MdgEntityFactory->create();

        try {
            $this->resource->load($MdgEntity, $id);
        } catch (\Exception $exception) {
            throw new NoSuchEntityException(
                __("The product that was requested doesn't exist. Verify the product and try again.")
            );
        }

        return $MdgEntity;
    }

    /**
     * @param \Learning\TenthTask\Model\MdgEntity $entity
     * @return bool
     * @throws \Exception
     */
    public function delete($entity): bool
    {
        $this->resource->delete($entity);
        return true;
    }

    public function deleteById($id): bool
    {
        $MdgEntity = $this->MdgEntityFactory->create();

        try {
            $this->resource->load($MdgEntity, $id);

            $this->resource->delete($MdgEntity);

        } catch (\Exception $exception) {
            throw new NoSuchEntityException(
                __("The product that was requested doesn't exist. Verify the product and try again.")
            );
        }
        return true;
    }

    public function getList()
    {
        try {
        }
        catch (\Exception $exception)
        {

        }
    }

    public function getListById()
    {
        // TODO: Implement getListById() method.

    }
}
