<?php
Mage::log("Voy a instalar");
$installer = $this;
//throw new Exception("This is an exception to stop the installer from completing");



$installer->startSetup();


$installer->addEntityType('complexworld_eavblogpost', array(
    //entity_mode is the URI you'd pass into a Mage::getModel() call
    'entity_model'    => 'complexworld/eavblogpost',

    //table refers to the resource URI complexworld/eavblogpost
    //<complexworld_resource>...<eavblogpost><table>eavblog_posts</table>
    'table'           =>'complexworld/eavblogpost',
));
Mage::log('Voy a crear la tabla');
//$table = $installer->getConnection()->newTable($installer->getTable('complexworld/eavblogpost'));
Mage::log('Se tenía que haber creado');


//optengo el nombre de la tabla sin el prefijo
$table = strtolower(substr(ltrim($this->getTable('complexworld/eavblogpost')), strlen(Mage::getConfig()->getTablePrefix())));
$installer->createEntityTables( $table		
    //$this->getTable('complexworld/eavblogpost')
);

$this->addAttribute('complexworld_eavblogpost', 'title', array(
    //the EAV attribute type, NOT a MySQL varchar
    'type'              => 'varchar',
    'label'             => 'Title',
    'input'             => 'text',
    'class'             => '',
    'backend'           => '',
    'frontend'          => '',
    'source'            => '',
    'required'          => true,
    'user_defined'      => true,
    'default'           => '',
    'unique'            => false,
));
$this->addAttribute('complexworld_eavblogpost', 'content', array(
    'type'              => 'text',
    'label'             => 'Content',
    'input'             => 'textarea',
));
$this->addAttribute('complexworld_eavblogpost', 'date', array(
    'type'              => 'datetime',
    'label'             => 'Post Date',
    'input'             => 'datetime',
    'required'          => false,
));

$installer->endSetup();