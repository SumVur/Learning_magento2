<?php

namespace Learning\FifthTask\Plugin;

/**
 * Class AroundProductSavePlugin
 * @package Learning\FifthTask\Plugin
 */
class AroundProductSavePlugin
{
    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * As was discussed in task #5.3
     */
    private const DateRubicone  = 100;
    /**
     * AroundProductSavePlugin constructor.
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(\Psr\Log\LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param \Magento\Catalog\Api\Data\ProductInterface $product
     * @param callable $proceed
     * @return mixed
     */
    public function aroundSave( \Magento\Catalog\Model\ResourceModel\Product $product, callable $proceed): callable
    {
        $this->logger->info(sprintf("SKU: %s is NEW ", $product->getSku()));
        $result = $proceed();
        if ($product->getPrice() < self::DateRubicone)
        {
            $this->logger->info(sprintf("SKU: %s price lower then 100", $product->getSku()));
        }
        return $result;
    }
}
