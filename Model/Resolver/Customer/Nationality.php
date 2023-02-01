<?php

declare(strict_types=1);

namespace Binstellar\MyAccount\Model\Resolver\Customer;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Model\Customer;

class Nationality implements ResolverInterface
{

    protected $storeManager;

     /**
     * @var CustomerRepositoryInterface
     */
    protected $customerRepository;

    // You can inject relevant classes in this constructor function.
    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        CustomerRepositoryInterface $customerRepository,
        Customer $Customer
    )
    {
        $this->storeManager = $storeManager;
        $this->_customerRepository = $customerRepository;
        $this->Customer = $Customer;
    }

    // This is the function which will get invoked when we request 'occupation' info in the graphql query 
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        if (!isset($value['model'])) {
            throw new LocalizedException(__('"model" value should be specified'));
        }
        $output = [];
        $customer = $value['model'];
        $customerId = (int)$customer->getId();

        // Get the custom attribute info of the customer.
        $nationality = $this->getCustomerNationality($customerId);

        return $nationality;
    }

    private function getCustomerNationality($customerId)
    {
        // Get the value of customer's occupation attribute and return it.

        $customer = $this->Customer->load($customerId);

        //Get segments text
        $nationality = $customer->getResource()
        ->getAttribute('nationality')
            ->getSource()
                ->getOptionText($customer->getData('nationality'));
        return $nationality;
    }
}