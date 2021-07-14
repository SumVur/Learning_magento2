<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Learning\TenthTask\Controller\Adminhtml\Index;


use Learning\TenthTask\Api\Data\MdgEntityInterface;
use Learning\TenthTask\Model\MdgEntity as MdgEntityAlias;
use Learning\TenthTask\Model\MdgEntityRepository as MdgEntityRepositoryAlias;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory as JsonFactoryAlias;

/**
 *
 * Customer inline edit action
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Save extends Action implements HttpPostActionInterface
{
    /**
     * @var JsonFactoryAlias
     */
    protected $resultJsonFactory;

    /**
     * @var MdgEntityRepositoryAlias
     */
    private $MdgEntityRepository;

    public function __construct(
        Context $context,
        JsonFactoryAlias $resultJsonFactory,
        MdgEntityRepositoryAlias $MdgEntityRepository
    )
    {
        $this->resultJsonFactory = $resultJsonFactory;
        parent::__construct($context);
        $this->MdgEntityRepository = $MdgEntityRepository;
    }

    public function execute()
    {
        /** @var Json $resultJson */
        $resultJson = $this->resultJsonFactory->create();

        $postItems = $this->getRequest()->getParam('items', []);
        if (!($this->getRequest()->getParam('isAjax') && count($postItems))) {
            return $resultJson->setData(
                [
                    'messages' => [
                        __('Please correct the data sent.')
                    ],
                    'error' => true,
                ]
            );
        }
        $postItems = $postItems[array_key_first($postItems)];
        $obj = $this->MdgEntityRepository->getById($postItems[MdgEntityInterface::entityId]);

        return $resultJson->setData(
            [
                'messages' =>$this->saveModel($obj,$postItems)->getData()
            ]
        );
    }

    public function saveModel(MdgEntityAlias $model, $postItems)
    {
        $model->setTitle($postItems[MdgEntityInterface::title]);
        $model->setStatus($postItems[MdgEntityInterface::status]);
        $model->setDescription($postItems[MdgEntityInterface::description]);
        return $this->MdgEntityRepository->save($model);
    }
}
