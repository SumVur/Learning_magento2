<?php

namespace Learning\TenthTask\Api;


interface MdgEntityRepositoryInterface
{
    public function create();

    public function save($entity);

    public function getById($id);

    public function delete($entity);

    public function deleteById($id);

    public function getList();

    public function getListById();
}
