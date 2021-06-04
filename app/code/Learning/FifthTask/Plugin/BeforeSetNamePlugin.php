<?php
namespace Learning\FifthTask\Plugin;


class BeforeSetNamePlugin
{
    /**
     * @param \Magento\Catalog\Model\Product $subject
     * @param string $name
     * @return string
     */
    public function beforeSetName(\Magento\Catalog\Model\Product $subject, string $name): string
    {
        return sprintf("%s_customized", $name);
    }
}
