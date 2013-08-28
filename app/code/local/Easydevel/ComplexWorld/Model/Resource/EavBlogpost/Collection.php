<?php
class Easydevel_ComplexWorld_Model_Resource_EavBlogpost_Collection extends 
Mage_Eav_Model_Entity_Collection_Abstract
//Mage_Core_Model_Resource_Db_Collection_Abstract
{	
    protected function _construct()
    {
        $this->_init('complexworld/eavblogpost');
    }
}