<?php
namespace Binstellar\MyAccount\Helper;
 
use Magento\Customer\Helper\View as MainHelper;
use Magento\Customer\Api\CustomerNameGenerationInterface;
use Magento\Customer\Api\CustomerMetadataInterface;
use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Escaper;
 
class View extends MainHelper
{

	/**
     * @var CustomerMetadataInterface
     */
    protected $_customerMetadataService;

    /**
     * @var Escaper
     */
    private $escaper;

    /**
     * Initialize dependencies.
     *
     * @param CustomerMetadataInterface $customerMetadataService
     * @param Escaper|null $escaper
     */
    public function __construct(
        CustomerMetadataInterface $customerMetadataService,
        Escaper $escaper = null
    ) {
        $this->_customerMetadataService = $customerMetadataService;
        $this->escaper = $escaper ?? ObjectManager::getInstance()->get(Escaper::class);
    }

    /**
     * @inheritdoc
     */
    public function getCustomerName(CustomerInterface $customerData)
    {
        $name = '';
        $prefixMetadata = $this->_customerMetadataService->getAttributeMetadata('prefix');
        if ($prefixMetadata->isVisible() && $customerData->getPrefix()) {
            $name .= __($customerData->getPrefix()) . ' ';
        }

        $name .= $customerData->getFirstname();

        $middleNameMetadata = $this->_customerMetadataService->getAttributeMetadata('middlename');
        if ($middleNameMetadata->isVisible() && $customerData->getMiddlename()) {
            $name .= ' ' . $customerData->getMiddlename();
        }

        $name .= ' ' . $customerData->getLastname();

        $suffixMetadata = $this->_customerMetadataService->getAttributeMetadata('suffix');
        if ($suffixMetadata->isVisible() && $customerData->getSuffix()) {
            $name .= ' ' . __($customerData->getSuffix());
        }
        return $this->escaper->escapeHtml($name);
    }
}