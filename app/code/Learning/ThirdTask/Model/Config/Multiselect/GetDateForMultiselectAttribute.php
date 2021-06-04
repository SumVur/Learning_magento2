<?php

namespace Learning\ThirdTask\Model\Config\Multiselect;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

/**
 * Class GetDateForMultiselectAttribute
 * @package Learning\ThirdTask\Setup\Model\Config\Multiselect
 */
class GetDateForMultiselectAttribute extends AbstractSource
{

    /**
     * @return array|array[]
     */
    public function getAllOptions(): array
    {
        return [
            ['label' => 'Label 1', 'value' => 'value 1'],
            ['label' => 'Label 2', 'value' => 'value 2']
        ];
    }
}
