<?php


namespace Learning\TenthTask\Controller\Adminhtml\Entities;

use Learning\TenthTask\Api\Data\MdgEntityInterface;
use Learning\TenthTask\Model\MdgEntity as MdgEntityAlias;
use Magento\Framework\Controller\ResultFactory;
use Learning\TenthTask\Model\MdgEntityRepository as MdgEntityRepositoryAlias;


class upload extends \Magento\Backend\App\Action
{

    private \Magento\Framework\File\Csv $csv;
    private MdgEntityRepositoryAlias $MdgEntityRepository;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\File\Csv $csv,
        MdgEntityRepositoryAlias $MdgEntityRepository

    )
    {
        parent::__construct($context);

        $this->csv = $csv;
        $this->MdgEntityRepository = $MdgEntityRepository;
    }


    public function execute()
    {
        $field = [];
        $resultData=[];
        if (str_contains($_FILES['bar']['type'], 'csv')) {
            $csvData = $this->csv->getData($_FILES['bar']['tmp_name']);
            foreach ($csvData as $row => $data) {
                if ($row > 0) {
                    $obj = $this->MdgEntityRepository->create();
                    $objData=[];
                    foreach ($data as $column=>$columnItem)
                    {
                        $objData[$field[$column]]=$columnItem;
                    }
                    $resultData[]=$this->saveModel($obj,$objData)->toArray();
                }else{
                    foreach ($data as $column=>$columnItem)
                    {
                        $field[$column]=$columnItem;
                    }
                }
            }
        }
        try {
            $result['ImportData'] = $resultData;
        } catch (\Exception $e) {
            $result = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
        }
        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($result);
    }

    public function saveModel(MdgEntityAlias $model, $postItems)
    {
        $model->setTitle($postItems[MdgEntityInterface::title]);
        $model->setStatus($postItems[MdgEntityInterface::status]);
        $model->setDescription($postItems[MdgEntityInterface::description]);
        $model->setProductId($postItems[MdgEntityInterface::productId]);
        $model->setCreatedDate($postItems[MdgEntityInterface::createdDate]);
        $model->setUpdatedDate($postItems[MdgEntityInterface::updatedDate]);
        return $this->MdgEntityRepository->save($model);
    }

}
