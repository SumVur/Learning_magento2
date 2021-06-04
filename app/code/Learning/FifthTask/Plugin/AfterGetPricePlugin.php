<?php
namespace Learning\FifthTask\Plugin;

/**
 * Class AfterGetPricePlugin
 * @package Learning\FifthTask\Plugin
 */
class AfterGetPricePlugin
{
    /**
     * As was discussed in task #1
     */
    private const DOUBLED = 2;

    /**
     * @param \Magento\Catalog\Model\Product $subject
     * @param $price
     * @return float
     */
    public function afterGetPrice(\Magento\Catalog\Model\Product $subject, $price): float
    {
        return (float) $price * self::DOUBLED;
    }
}
