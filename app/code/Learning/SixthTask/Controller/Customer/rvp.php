<?php
namespace Learning\SixthTask\Controller\Customer;

use Magento\Framework\App\Action\Context;

/**
 * Class rvp
 * @package Learning\SixthTask\Controller\Customer
 */
class rvp extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    private $_pageFactory;

    /**
     * @var \Magento\Customer\Model\Session
     */
    private $customerSession;

    /**
     * @var \Magento\Framework\UrlInterface
     */
    private $urlInterface;

    /**
     * rvp constructor.
     * @param Context $context
     * @param \Magento\Customer\Model\Session $sessionFactory
     * @param \Magento\Framework\View\Result\PageFactory $pageFactory
     * @param \Magento\Framework\UrlInterface $urlInterfaceFactory
     */
    public function __construct(
        Context $context,
        \Magento\Customer\Model\Session  $sessionFactory,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\UrlInterface $urlInterfaceFactory
    )
    {
        parent::__construct($context);
        $this->_pageFactory = $pageFactory;
        $this->customerSession = $sessionFactory;
        $this->urlInterface = $urlInterfaceFactory;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        if(!$this->customerSession->isLoggedIn()) {
            $this->customerSession->setAfterAuthUrl($this->urlInterface->getCurrentUrl());
            $this->customerSession->authenticate();
        }
        return $this->_pageFactory->create();

    }


}
