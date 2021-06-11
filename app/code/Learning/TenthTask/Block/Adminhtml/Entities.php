<?php
namespace Learning\TenthTask\Block\Adminhtml;

class Entities extends \Magento\Backend\Block\Widget\Grid\Container
{

    protected function _construct()
    {
        $this->_controller = 'adminhtml_entities';
        $this->_blockGroup = 'Learning_TenthTask';
        $this->_headerText = __('Posts');
        $this->_addButtonLabel = __('Create New Post');
        parent::_construct();
    }
}
