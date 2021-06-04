<?php

namespace Learning\FirstTask\Observer;

use Magento\Framework\App\ObjectManager;
use Magento\Framework\App\Request\Http;

class AddFirstnameAndLastName implements \Magento\Framework\Event\ObserverInterface
{
    /** @var Http  */
    private $request;

    /**
     * Subscriber constructor.
     * @param Http $request
     */
    public function __construct(Http $request)
    {
        $this->request = $request;
    }
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $firstname = $this->request->getPost('firstname');
        $lastname = $this->request->getPost('lastname');

        if($firstname&&$lastname) {
            /** @var \Magento\Newsletter\Model\Subscriber $subscriber */
            $subscriber = $observer->getData('subscriber');
            $subscriber->setData('s_firstname', $firstname);
            $subscriber->setData('s_lastname', $lastname);
        }
        return $this;
    }
}
