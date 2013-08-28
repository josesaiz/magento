<?php
class Easydevel_ComplexWorld_Model_Resource_EavBlogpost extends 
//Mage_Core_Model_Resource_Db_Abstract
Mage_Eav_Model_Entity_Abstract
{
    protected function _construct()
    {
    	Mage::log("Contruct resource");
    	//$this->_init('weblog/blogpost', 'blogpost_id');
        $resource = Mage::getSingleton('core/resource');
        $this->setType('complexworld_eavblogpost');
        $this->setConnection(
            $resource->getConnection('complexworld_read'),
            $resource->getConnection('complexworld_write')
        );
        Mage::log("Salgo Contruct resource");
    }
}