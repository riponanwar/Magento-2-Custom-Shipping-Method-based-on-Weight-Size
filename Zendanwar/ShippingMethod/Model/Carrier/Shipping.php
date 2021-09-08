<?php
namespace Zendanwar\ShippingMethod\Model\Carrier;

use Magento\Quote\Model\Quote\Address\RateRequest;
use Magento\Shipping\Model\Rate\Result;

class Shipping extends \Magento\Shipping\Model\Carrier\AbstractCarrier implements
    \Magento\Shipping\Model\Carrier\CarrierInterface
{
    /**
     * @var string
     */
    protected $_code = 'simpleshipping';

    /**
     * @var \Magento\Shipping\Model\Rate\ResultFactory
     */
    protected $_rateResultFactory;

    /**
     * @var \Magento\Quote\Model\Quote\Address\RateResult\MethodFactory
     */
    protected $_rateMethodFactory;

	protected $_attributeFactory;

    /**
     * Shipping constructor.
     *
     * @param \Magento\Framework\App\Config\ScopeConfigInterface          $scopeConfig
     * @param \Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory  $rateErrorFactory
     * @param \Psr\Log\LoggerInterface                                    $logger
     * @param \Magento\Shipping\Model\Rate\ResultFactory                  $rateResultFactory
     * @param \Magento\Quote\Model\Quote\Address\RateResult\MethodFactory $rateMethodFactory
     * @param array                                                       $data
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory $rateErrorFactory,
        \Psr\Log\LoggerInterface $logger,
		\Magento\Catalog\Model\ResourceModel\Eav\Attribute $attributeFactory,
        \Magento\Shipping\Model\Rate\ResultFactory $rateResultFactory,
        \Magento\Quote\Model\Quote\Address\RateResult\MethodFactory $rateMethodFactory,
        array $data = []
    ) {
        $this->_rateResultFactory = $rateResultFactory;
        $this->_rateMethodFactory = $rateMethodFactory;
		$this->_attributeFactory = $attributeFactory;
        parent::__construct($scopeConfig, $rateErrorFactory, $logger, $data, $attributeFactory);
    }

    /**
     * get allowed methods
     * @return array
     */
    public function getAllowedMethods()
    {
        return [$this->_code => $this->getConfigData('name')];
    }

    /**
     * @return float
     */
    private function getShippingPrice()
    {
        $configPrice = $this->getConfigData('price');

        $shippingPrice = $this->getFinalPriceWithHandlingFee($configPrice);

        return $shippingPrice;
    }

    /**
     * @param RateRequest $request
     * @return bool|Result
     */
    public function collectRates(RateRequest $request)
    {
        if (!$this->getConfigFlag('active')) {
            return false;
        }
		
		$products = $request->getAllItems();
				
		foreach($products as $product)
		{
		   $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		   $productId = $product->getProduct()->getId();
		   $product = $objectManager->create('Magento\Catalog\Model\Product')->load($productId);
		   $shippingCode = $product->getData('shipping_code');
		   
		   $productWeight 	= $product->getWeight();     
		   $productSize 	= $product->getData('csize');
		}
		
		$amount = $this->getShippingPrice();

		if ($productWeight > "10" && $productSize < "100"){
			$amount = "100";
		}elseif($productWeight < "10" && $productSize > "100"){
			$amount = "90";
		}elseif($productWeight > "10" && $productSize > "100"){
			$amount = "150";
		}elseif($productWeight < "10" && $productSize < "100"){
			$amount = "60";
		}else{
			$amount = $this->getShippingPrice();
		}
		
        /** @var \Magento\Shipping\Model\Rate\Result $result */
        $result = $this->_rateResultFactory->create();

        /** @var \Magento\Quote\Model\Quote\Address\RateResult\Method $method */
        $method = $this->_rateMethodFactory->create();

        $method->setCarrier($this->_code);
        $method->setCarrierTitle($this->getConfigData('title'));

        $method->setMethod($this->_code);
        $method->setMethodTitle($this->getConfigData('name'));

        

        $method->setPrice($amount);
        $method->setCost($amount);

        $result->append($method);

        return $result;
    }
	public function Walton()
	{
    $attributeInfo = $this->_attributeFactory->getCollection();

   foreach($attributeInfo as $attributes)
   { 
        // custome size attribute id
        $attributeId = $attributes->getAttributeId(165);
       
   }
}
}