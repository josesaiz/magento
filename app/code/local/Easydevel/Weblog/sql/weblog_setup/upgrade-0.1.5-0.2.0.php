<?php
echo 'Testing our upgrade script (upgrade-0.1.5-0.2.0.php) and halting execution to avoid updating the system version number <br />';
$installer = $this;
$installer->startSetup();
$installer->getConnection()
    ->changeColumn($installer->getTable('weblog/blogpost'), 'post', 'post', array(
        'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
        'nullable' => false,
        'comment' => 'Blogpost Body'
    )
);
$installer->endSetup();
//die("You'll see why this is here in a second");