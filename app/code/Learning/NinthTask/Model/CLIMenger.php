<?php


namespace Learning\NinthTask\Model;

use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Customer\Model\ResourceModel\Customer\CollectionFactory as CustomerFactory;
use Magento\Customer\Model\ResourceModel\Online\Grid\CollectionFactory as OnlineCollectionFactory;

class CLIMenger
{
    /**
     * @var CustomerFactory
     */
    private CustomerFactory $customerFactory;
    /**
     * @var OnlineCollectionFactory
     */
    private OnlineCollectionFactory $onlineCollectionFactory;

    /**
     * CLIMenger constructor.
     * @param CustomerFactory $customerFactory
     * @param OnlineCollectionFactory $onlineCollectionFactory
     */
    public function __construct(
        CustomerFactory $customerFactory,
        OnlineCollectionFactory $onlineCollectionFactory
    )
    {
        $this->customerFactory = $customerFactory;
        $this->onlineCollectionFactory = $onlineCollectionFactory;
    }

    /**
     * @param string $Option
     * @return array|string[]|\string[][]
     * @throws \Exception
     */
    public function CommandManger(string $Option): array
    {
        switch ($Option) {
            case "registered":
            {
                return $this->GetUsersRegisteredInLast24Hours();
            }
            case "online":
            {
                return $this->GetOnlineCustomers();
            }
            case "blocked":
            {
                return $this->GetLockedUsers();
            }
            default:
            {
                return [
                    ["Info" => "lol hm"]];
                break;
            }
        }
    }

    /**
     * @return array|string[]
     * @throws \Magento\Framework\Exception\LocalizedException\
     */
    private function GetUsersRegisteredInLast24Hours(): array
    {
        $users = $this->customerFactory->create()
            ->addAttributeToFilter('created_at',
                [
                    'from' => date('Y-m-d h:i:s \G\M\T', mktime(0, 0, 0, date('m'), date('d') - 1, date('Y'))),
                    'to' => gmdate('Y-m-d h:i:s \G\M\T'),
                ]);
        $resultUsers = [];
        foreach ($users as $User) {
            /** @var CustomerInterface $User */
            $resultUsers[] = [
                "firstname" => $User->getFirstname(),
                "lastname" => $User->getLastname(),
                "email" => $User->getEmail()
            ];
        }
        if (empty($resultUsers)) {
            $resultUsers = [
                "Info" => "no registered users in half last 24 hours",
            ];
        }
        return $resultUsers;
    }

    /**
     * @return array|string[]
     */
    private function GetOnlineCustomers(): array
    {
        $Users = $this->onlineCollectionFactory->create();

        $resultUsers = [];
        foreach ($Users as $User)
        {
            /** @var CustomerInterface $User */
            $resultUsers[] = [
                "firstname" => $User->getFirstname(),
                "lastname" => $User->getLastname(),
                "email" => $User->getEmail()
            ];
        }
        if (empty($resultUsers))
        {
            $resultUsers = [
                "Info" => "No Online users",
            ];
        }
        return $resultUsers;
    }

    /**
     * @return array|string[]
     * @throws \Exception
     */
    private function GetLockedUsers(): array
    {

        $users = $this->customerFactory->create();
        $resultUsers = [];
        foreach ($users as $user) {
            /** @var CustomerInterface $user */
            if ($user->isCustomerLocked())
            {
                $LockExpires = new \DateTime($user->getLockExpires());

                $resultUsers[] = [
                    "firstname" => $user->getFirstname(),
                    "lastname" => $user->getLastname(),
                    "email" => $user->getEmail(),
                    "Lock Expires" => $LockExpires->format('j-M-Y :T')
                ];
            }
        }
        if (empty($resultUsers))
        {
            $resultUsers = [
                "Info" => "No locked users",
            ];
        }
        return $resultUsers;

    }
}
