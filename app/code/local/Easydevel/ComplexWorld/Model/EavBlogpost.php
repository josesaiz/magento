<?php
class Easydevel_ComplexWorld_Model_EavBlogpost extends 
Mage_Core_Model_Abstract{
//Mage_Core_Model_Resource_Db_Abstract{

	protected function _construct()
    {
        
		Mage::log("Contruct Model");
		//$this->_init('weblog/blogpost', 'blogpost_id');
    	$this->_init('complexworld/eavblogpost');
    	Mage::log("Salgo Contruct Model");
    }
}
