<?php declare(strict_types=1);

namespace Binstellar\MyAccount\Setup\Patch\Data;

use Zend_Validate_Exception;
use Magento\Eav\Model\Config;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Eav\Model\Entity\Attribute\Source\Boolean;
use Magento\Eav\Model\Entity\Attribute\SetFactory as AttributeSetFactory;

/**
 * Patch Class to create b2b_user attribute 
 */
class PreferredLanguageDD implements DataPatchInterface
{
    /**
     * @var Config
     */
    private $eavConfig;

    /**
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * @var AttributeSetFactory
     */
    private $attributeSetFactory;

    /**
     * AddressAttribute constructor.
     *
     * @param Config              $eavConfig
     * @param EavSetupFactory     $eavSetupFactory
     * @param AttributeSetFactory $attributeSetFactory
     */
    public function __construct(
        Config $eavConfig,
        EavSetupFactory $eavSetupFactory,
        AttributeSetFactory $attributeSetFactory
    ) {
        $this->eavConfig = $eavConfig;
        $this->eavSetupFactory = $eavSetupFactory;
        $this->attributeSetFactory = $attributeSetFactory;
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies(): array
    {
        return [];
    }

    /**
     * Create strategic account customer attribute
     * @return void
     * @throws LocalizedException
     * @throws Zend_Validate_Exception
     */
    public function apply(): void
    {
        $eavSetup = $this->eavSetupFactory->create();

        $customerEntity = $this->eavConfig->getEntityType('customer');
        $attributeSetId = $customerEntity->getDefaultAttributeSetId();

        $attributeSet = $this->attributeSetFactory->create();
        $attributeGroupId = $attributeSet->getDefaultGroupId($attributeSetId);

        $eavSetup->addAttribute('customer', 'preferred_language', [
            'type'             => 'int',
            'input'            => 'select',
            'label'            => 'Preferred Language',
            'visible'          => true,
            'source'           => 'Magento\Eav\Model\Entity\Attribute\Source\Table',
            'required'         => false,
            'user_defined'     => true,
            'system'           => false,
            'global'           => true,
            'default'          => 0,
            'visible_on_front' => false,
            'sort_order'       => 50,
            'position'         => 50,
            'option' => ['value' => 
                            [
                             'option_1'=>[ 
                            //option_1 will be static it will add below labels in option_1 for **new**
                                  0=>'Arabic'
                                  ],
                            'option_2'=>[
                                  0=>'English'
                                  ],
                            ], 
        ],
    ]);


        $customAttribute = $this->eavConfig->getAttribute('customer', 'preferred_language');

        $customAttribute->addData([
            'attribute_set_id' => $attributeSetId,
            'attribute_group_id' => $attributeGroupId,
            'used_in_forms' => ['adminhtml_customer', 'customer_account_edit']
        ]);
        $customAttribute->save();
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases(): array
    {
        return [];
    }
}