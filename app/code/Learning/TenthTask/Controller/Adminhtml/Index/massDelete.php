<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Learning\TenthTask\Controller\Adminhtml\Index;


use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Learning\TenthTask\Model\MdgEntityRepository as MdgEntityRepositoryAlias;


/**
 * Customer inline edit action
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class massDelete extends \Magento\Backend\App\Action implements HttpPostActionInterface
{
    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $resultJsonFactory;

    /**
     * @var \Learning\TenthTask\Model\MdgEntityRepository
     */
    private $MdgEntityRepository;

    public function __construct(
        Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        MdgEntityRepositoryAlias $MdgEntityRepository)
    {
        $this->resultJsonFactory = $resultJsonFactory;
        parent::__construct($context);
        $this->MdgEntityRepository = $MdgEntityRepository;
    }

    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->resultJsonFactory->create();

        $postItems = $this->getRequest()->getParam('selected');
        $result = $postItems;
        if (!($this->getRequest()->getParam('isAjax') && count($postItems))) {
            foreach ($postItems as $item) {
                $this->MdgEntityRepository->deleteById($item);
            }
        }
        $this->messageManager->addSuccessMessage(
            __('A total of record(s) have been deleted.')
        );

        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('tenthtask/entities/index');

    }
}
