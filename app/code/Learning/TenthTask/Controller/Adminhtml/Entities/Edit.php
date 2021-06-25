<?php
namespace Learning\TenthTask\Controller\Adminhtml\Entities;


class Edit extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Learning_TenthTask::Manage_Entities';

    protected $resultPageFactory = false;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend((__('MdgEntity Edit')));
        return $resultPage;
    }
}
