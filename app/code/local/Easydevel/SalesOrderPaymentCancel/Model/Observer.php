<?php
class Easydevel_SalesOrderPaymentCancel_Model_Observer      
      
{
 	public function __construct()
    {
    }
    public function cancel(Varien_Event_Observer $observer)
    {
    	
    	
    	

        $lastOrderId = Mage::getSingleton('checkout/session')
               ->getLastRealOrderId();
    	$orderId = Mage::getModel('sales/order')
               ->loadByIncrementId($lastOrderId)
               ->getEntityId();
		$order = Mage::getModel('sales/order')->load($orderId);
		
            $this->_sendSalesOrderPaymentCancelMail($order);
        
            
        
	}
	private  function _sendSalesOrderPaymentCancelMail($order){

		$helper = Mage::helper('onestepcheckout');
		
			$translate = Mage::getSingleton('core/translate');
			$translate->setTranslateInline(false);			
			
			$paymentBlock = Mage::helper('payment')->getInfoBlock($order->getPayment())
            ->setIsSecureMode(true);
			$paymentBlock->getMethod()->setStore($order->getStore()->getId());
			
			$mailTemplate = Mage::getModel('core/email_template');
			$template = Mage::getStoreConfig('onestepcheckout/order_notification/template', $order->getStoreId());
			
			$sendTo = array();
			$email_array = $helper->getEmailArray();
			if (!empty($email_array)) {
				foreach ($email_array as $email) {
					$sendTo[] = array('email' => trim($email),
														'name'	=> '');
				}
			}
		
			foreach ($sendTo as $recipient) {
				$result = $mailTemplate->setDesignConfig(array('area'=>'frontend', 'store'=>$order->getStoreId()))
					->sendTransactional(
						$template,
						Mage::getStoreConfig('sales_email/order/identity', $order->getStoreId()),
						$recipient['email'],
						$recipient['name'],
						array(
								'order'         => $order,
								'billing'       => $order->getBillingAddress(),
								'payment_html'  => $paymentBlock->toHtml(),
						)
					);
			}
			$translate->setTranslateInline(true);
			
		}
		
	
}
