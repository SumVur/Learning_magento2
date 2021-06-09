<?php
namespace Learning\EightTask\Cron;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Framework\Filesystem;
use Magento\Framework\Filesystem\Directory\WriteInterface;
use Psr\Log\LoggerInterface;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Sales\Model\ResourceModel\Report\Bestsellers\CollectionFactory as BestSellersCollectionFactory;

/**
 * Class Test
 * @package Magento\SampleMinimal\Cron
 */
class Test
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var WriteInterface
     */
    private $directory;

    /**
     * @var BestSellersCollectionFactory
     */
    private $bestSellersCollectionFactory;

    /**
     * @var CollectionFactory
     */
    private $productCollectionFactory;

    public function __construct(
        LoggerInterface $logger,
        Filesystem $filesystem,
        CollectionFactory $productCollectionFactory,
        BestSellersCollectionFactory $bestSellersCollectionFactory

    ){
        $this->logger = $logger;
        $this->directory = $filesystem->getDirectoryWrite(DirectoryList::VAR_DIR);
        $this->productCollectionFactory=$productCollectionFactory;
        $this->bestSellersCollectionFactory = $bestSellersCollectionFactory;
    }

    /**
     * @throws \Magento\Framework\Exception\FileSystemException
     */
    public function execute() :void
    {
        $bestSellers = $this->bestSellersCollectionFactory->create()
            ->setPeriod('month');

        if($bestSellers->count())
        {
            $filepath = 'media/export/day_bestseller.csv';
            $this->directory->create('export');
            $stream = $this->directory->openFile($filepath, 'w+');
            $stream->lock();
            $header = ['Sku', 'Name', 'Price', 'Day sell qty'];
            $stream->writeCsv($header);

            $productsQtyOrder = [];
            foreach ($bestSellers as $product) {
                $productsQtyOrder[$product->getProductId()] = $product->getQtyOrdered();
            }

            $productIds = array_keys($productsQtyOrder);

            $productCollection = $this->productCollectionFactory->create()->addIdFilter($productIds);
            $productCollection->addAttributeToSelect('name');

            foreach ($productCollection as $product) {
                /** @var ProductInterface $product **/
                $data = [];
                $data[] = $product->getSku();
                $data[] = $product->getName();
                $data[] = $product->getPrice();
                $data[] = $productsQtyOrder[$product->getId()];
                $stream->writeCsv($data);
            }
        }
    }
}
