<?php
namespace Binstellar\MyAccount\Block;
class CustomAttributeDetails extends \Magento\Framework\View\Element\Template
{
	protected $_productloader;
	protected $_scopeConfig;
	protected $_storeManager;

	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Magento\Catalog\Model\ProductFactory $_productloader,
		\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
		\Magento\Store\Model\StoreManagerInterface $storeManager
	)
	{	
		$this->_productloader = $_productloader;
		$this->_scopeConfig = $scopeConfig;
		$this->_storeManager = $storeManager;
		parent::__construct($context);
	}

	public function getLoadProduct($id)
    {
        return $this->_productloader->create()->load($id);
    }

    public function getCurrentStoreLocale()
    {
    	return $this->_scopeConfig->getValue('general/locale/code', \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $this->_storeManager->getStore()->getId());
    }
}