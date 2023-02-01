<?php
namespace Binstellar\MyAccount\Block;

use Magento\Framework\App\Http\Context as HttpContext;

class CustomerLogin extends \Magento\Framework\View\Element\Template
{
	protected $customerSession;
	protected $_storeManager;

	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Magento\Customer\Model\Session $customerSession,
		\Magento\Store\Model\StoreManagerInterface $storeManager,
		HttpContext $httpContext
	)
	{	
		$this->customerSession = $customerSession;
		$this->_storeManager = $storeManager;
		$this->httpContext = $httpContext;
		parent::__construct($context);
	}

	public function getBaseUrl()
	{
		return $this->_storeManager->getStore()->getBaseUrl();
	}

	public function getIsLoggedIn()
	{
		return (bool)$this->httpContext->getValue(\Magento\Customer\Model\Context::CONTEXT_AUTH);
	}

	public function getCustomerName()
	{
		$customerName = '';
		if($this->httpContext->getValue('prefix')){
			$customerName .= __($this->httpContext->getValue('prefix')).' ';
		}
		$customerName .=$this->httpContext->getValue('customer_name');
		return $customerName;
	}

	public function getCustomerSession()
	{
		return $this->customerSession;
	}
}