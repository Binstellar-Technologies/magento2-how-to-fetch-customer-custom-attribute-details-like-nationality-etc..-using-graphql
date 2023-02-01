<?php
namespace Binstellar\MyAccount\Plugin;

class CustomerSessionContext
{
    /**
 	* @var \Magento\Customer\Model\Session
 	*/
    protected $customerSession;

    /**
 	* @var \Magento\Framework\App\Http\Context
 	*/
    protected $httpContext;

    /**
 	* @param \Magento\Customer\Model\Session $customerSession
 	* @param \Magento\Framework\App\Http\Context $httpContext
 	*/
    public function __construct(
    	\Magento\Customer\Model\Session $customerSession,
    	\Magento\Framework\App\Http\Context $httpContext
    ) {
    	$this->customerSession = $customerSession;
    	$this->httpContext = $httpContext;
    }

    /**
 	* @param \Magento\Framework\App\ActionInterface $subject
 	* @param callable $proceed
 	* @param \Magento\Framework\App\RequestInterface $request
 	* @return mixed
 	*/
    public function aroundDispatch(
    	\Magento\Framework\App\ActionInterface $subject,
    	\Closure $proceed,
    	\Magento\Framework\App\RequestInterface $request
    ) {

        
        if($this->customerSession->getCustomer()->getPrefix()){            
                $this->httpContext->setValue(
                'prefix',
                $this->customerSession->getCustomer()->getPrefix(),
                false
            );
        }
        $name  = '';
        $name .= $this->customerSession->getCustomer()->getFirstname();
        if ($this->customerSession->getCustomer()->getMiddlename()) {
            $name .= ' ' . $this->customerSession->getCustomer()->getMiddlename();
        }
        $name .= ' ' . $this->customerSession->getCustomer()->getLastname();
        if ($this->customerSession->getCustomer()->getSuffix()) {
            $name .= ' ' . __($this->customerSession->getCustomer()->getSuffix());
        }



    	$this->httpContext->setValue(
        	'customer_id',
        	$this->customerSession->getCustomerId(),
        	false
    	);

    	$this->httpContext->setValue(
        	'customer_name',
        	$name,
        	false
    	);

    	$this->httpContext->setValue(
        	'customer_email',
        	$this->customerSession->getCustomer()->getEmail(),
        	false
    	);

    	return $proceed($request);
    }
}