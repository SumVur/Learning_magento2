<?php


namespace Learning\EleventhTask\Block\Checkout;


use Magento\Checkout\Block\Checkout\LayoutProcessorInterface;

class OurLayoutProcessor implements LayoutProcessorInterface
{

    private \Magento\Customer\Model\Session $customerSession;

    public function __construct(\Magento\Customer\Model\Session $session)
    {

        $this->customerSession = $session;
    }

    /**
     * @param array $jsLayout
     * @return array
     */
    public function process($jsLayout)
    {
        //%path_to_target_node% is the path to the component's node in checkout_index_index.
        if ($this->customerSession->isLoggedIn()) {
            unset($jsLayout['components']['checkout']['children']['steps']['children']['my-new-step']);
        }
        return $jsLayout;
    }
}
