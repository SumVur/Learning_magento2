<?php
namespace Learning\SeventhTask\CustomerData;

use Magento\Customer\CustomerData\SectionSourceInterface;
use Magento\Customer\Helper\Session\CurrentCustomer;
use Magento\Customer\Helper\View;

/**
 * Class CustomerPrivetInfo
 * @package Learning\SeventhTask\CustomerData
 */
class CustomerPrivetInfo implements SectionSourceInterface
{
    /**
     * @var CurrentCustomer
     */
    protected $currentCustomer;

    /**
     * @var View
     */
    private $customerViewHelper;

    /**
     * @var \Magento\Customer\Api\AddressRepositoryInterface
     */
    private $addressRepository;

    /**
     * @var \Magento\Directory\Model\CountryFactory
     */
    private $countryFactory;

    /**
     * CustomerPrivetInfo constructor.
     * @param CurrentCustomer $currentCustomer
     * @param View $customerViewHelper
     * @param \Magento\Customer\Api\AddressRepositoryInterface $addressRepository
     * @param \Magento\Directory\Model\CountryFactory $countryFactory
     */
    public function __construct(
        CurrentCustomer $currentCustomer,
        View $customerViewHelper,
        \Magento\Customer\Api\AddressRepositoryInterface $addressRepository,
        \Magento\Directory\Model\CountryFactory $countryFactory
    ) {
        $this->currentCustomer = $currentCustomer;
        $this->customerViewHelper = $customerViewHelper;
        $this->addressRepository = $addressRepository;
        $this->countryFactory = $countryFactory;
    }

    /**
     * {@inheritdoc}
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getSectionData(): array
    {
        if (!$this->currentCustomer->getCustomerId())
        {
            return [];
        }

        $customer = $this->currentCustomer->getCustomer();

        $defaultShipping = $this->addressRepository->getById($customer->getDefaultShipping());

        $countryCode = $defaultShipping->getCountryId();
        $country = $this->countryFactory->create()->loadByCode($countryCode);
        return [
            'Street' => sprintf("Street Address: %s", implode(",",$defaultShipping->getStreet())),
            'Country' => sprintf("Country: %s",$country->getName()),
            'Region' => sprintf("Region: %s", $defaultShipping->getRegionId()),
            'City' => sprintf("City: %s", $defaultShipping->getCity()),
        ];
    }
}
