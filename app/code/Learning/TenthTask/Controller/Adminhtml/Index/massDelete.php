<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Learning\TenthTask\Controller\Adminhtml\Index;


use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;

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
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
    )
    {
        $this->resultJsonFactory = $resultJsonFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->resultJsonFactory->create();

        $postItems = $this->getRequest()->getParam('items', []);
        if (!($this->getRequest()->getParam('isAjax') && count($postItems))) {

        }
        $this->messageManager->addSuccessMessage(
            __('A total of record(s) have been deleted.')
        );
        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('catalog/*/index');

    }
}
