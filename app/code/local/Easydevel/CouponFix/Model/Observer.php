<?php
class Easydevel_CouponFix_Model_Observer
{
 	public function __construct()
    {
    }
    public function cancel(Varien_Event_Observer $observer)
    {
    	
    	Mage::log("Entro en Cancel Pago");
    	
		  $event = $observer->getEvent();
		  $order = $event->getPayment()->getOrder();
		  if ($order->canCancel()) {
		    if ($code = $order->getCouponCode()) {
		      $coupon = mage::getModel('salesrule/coupon')->load($code, 'code');
		      if ($coupon->getTimesUsed() > 0) {
		        $coupon->setTimesUsed($coupon->getTimesUsed()-1);
		        $coupon->save();
		      }
		 
		      $rule = Mage::getModel('salesrule/rule')->load($coupon->getRuleId());
		      error_log("\nrule times used=" . $rule->getTimesUsed(),3,"var/log/debug.log");
		      if ($rule->getTimesUsed() > 0) {
		        $rule->setTimesUsed($rule->getTimesUsed()-1);
		        $rule->save();
		      }
		      if($customerId = $order->getCustomerId()) {
		        if ($customerCoupon = Mage::getModel('salesrule/rule_customer')->loadByCustomerRule($customerId, $rule->getId())) {
		          $couponUsage = new Varien_Object();
		          Mage::getResourceModel('salesrule/coupon_usage')->loadByCustomerCoupon($couponUsage, $customerId, $coupon->getId());
		 
		          if ($couponUsage->getTimesUsed() > 0) {
		 
		            /* I can't find any #@$!@$ interface to do anything but increment a coupon_usage record */
		            $resource = Mage::getSingleton('core/resource');
		            $writeConnection = $resource->getConnection('core_write');
		            $tableName = $resource->getTableName('salesrule_coupon_usage');		 			
		            if ($couponUsage->getTimesUsed()!=1){
		            	$query = "UPDATE {$tableName} SET times_used = times_used-1 " .
		              	" WHERE coupon_id = {$coupon->getId()} AND customer_id = {$customerId} AND times_used > 0";
		            }else{
		            	$query = "DELETE FROM {$tableName} ".
						" WHERE coupon_id = {$coupon->getId()} AND customer_id = {$customerId} AND times_used = 1";
		            };
		 
		            $writeConnection->query($query);
		          }
		          if ($customerCoupon->getTimesUsed() > 0) {
		            $customerCoupon->setTimesUsed($customerCoupon->getTimesUsed()-1);
		            $customerCoupon->save();
		          }
		        }
		      }
		    }
		  }
		    
    	
    	/* Solución Versiones anteriores de Magento
    	$event = $observer->getEvent();
        $order = $event->getPayment()->getOrder();
        //echo "------------------------------Cancel: ".$order->canCancel();
        //echo "<script>alert('hola mundo');</script>";
        Mage::log("Entro en canCancel");
        if ($order->canCancel()) {
        	Mage::log("Entro en getCouponCode");
        if ($code = $order->getCouponCode()) {
        	Mage::log("Entro en getModel");
            //$coupon = Mage::getModel('salesrule/rule')->load($code, 'coupon_code');
            $coupon = Mage::getModel('salesrule/coupon')->load($code, 'code');
            $coupon->setTimesUsed($coupon->getTimesUsed()-1);
            $coupon->save();
            Mage::log("Entro en getCustomerIdModel");
            if($customerId = $order->getCustomerId()) {            	
            	Mage::log("Entro en getModel2");
                //if ($customerCoupon = Mage::getModel('salesrule/rule_customer')->loadByCustomerRule($customerId, $coupon->getId())) {
                                                               
            	if ($customerCoupon = Mage::getModel('salesrule/coupon_usage')->loadByCustomerRule($customerId, $coupon->getId())) {
                    Mage::log("Entro en IF getModel");
                	$customerCoupon->setTimesUsed($customerCoupon->getTimesUsed()-1);
                    $customerCoupon->save();
                }
            }
        }
        */
        Mage::log("Salgo en Cancel Pago");
	}
}
