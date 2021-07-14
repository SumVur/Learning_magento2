<?php

namespace Learning\TwelfthTask\Model\Indexer;

use Magento\Framework\App\ResourceConnection;


class ChangeName implements \Magento\Framework\Indexer\ActionInterface, \Magento\Framework\Mview\ActionInterface
{
    private \Learning\TwelfthTask\Model\ChangeNameFactory $changeNameFactory;
    private $product;
    private ResourceConnection $resourceConnection;

    public function __construct(
        ResourceConnection $resourceConnection,
        \Learning\TwelfthTask\Model\ChangeNameFactory $changeNameFactory,
        \Magento\Catalog\Model\ProductFactory $product
    )
    {

        $this->changeNameFactory = $changeNameFactory;
        $this->product = $product;
        $this->resourceConnection = $resourceConnection;
    }

    /*
     * Used by mview, allows process indexer in the "Update on schedule" mode
     */
    public function execute($ids)
    {
         $sql ="select attribute_id from catalog_product_entity_varchar where value_id=".$ids;
        $connection = $this->resourceConnection->getConnection();
        $attribute_id = $connection->fetchAll($sql);
        if($attribute_id==73)
        {
            $this->product->create()->load($ids)->getName();

        }
    }

    /*
     * Will take all of the data and reindex
     * Will run when reindex via command line
     */
    public function executeFull()
    {
        //Should take into account all placed orders in the system
    }

    /*
     * Works with a set of entity changed (may be massaction)
     */
    public function executeList(array $ids)
    {
        //Works with a set of placed orders (mass actions and so on)
    }

    /*
     * Works in runtime for a single entity using plugins
     */
    public function executeRow($id)
    {
        die("Row");

    }
}
