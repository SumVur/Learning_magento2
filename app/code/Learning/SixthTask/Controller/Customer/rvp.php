<?php
namespace Learning\SixthTask\Controller\Customer;


class rvp extends \Magento\Framework\App\Action\Action
{
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }
}
?>
