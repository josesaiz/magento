<?php
class Easydevel_ComplexWorld_IndexController extends Mage_Core_Controller_Front_Action {
	public function indexAction() {
		Mage::log("toy en complexworld");
	    $weblog2 = Mage::getModel('complexworld/eavblogpost');
	    $weblog2->load(1);
	    var_dump($weblog2);
	    
	}	
	
	public function populateEntriesAction() {
	    for ($i=0;$i<10;$i++) {
	        $weblog2 = Mage::getModel('complexworld/eavblogpost');
	        $weblog2->setTitle('This is a test '.$i);
	        $weblog2->setContent('This is test content '.$i);
	        $weblog2->setDate(now());
	        $weblog2->save();
	    }
	
	    echo 'Done';
	}
	
	public function showCollectionAction() {
	    $weblog2 = Mage::getModel('complexworld/eavblogpost');
	    echo $weblog2;
	    //var_dump($weblog2);
	    for ($i=1;$i<=count($weblog2->getCollection()->getData());$i++){
	    $weblog2->load($i);
	    	echo $i;
	  		echo '<h2>' . $weblog2->getTitle() . '</h2>';
	        echo '<p>Date: ' . $weblog2->getDate() . '</p>';
	        echo '<p>' . $weblog2->getContent() . '</p>';
	    }  
	    $entries = $weblog2->getCollection()
	        ->addAttributeToSelect('title')
	        ->addAttributeToSelect('content');
 
	     /*
	    $entries->load();
	
	    foreach($weblog2 as $entry)
	    {
	        // var_dump($entry->getData());
	        echo '<h2>' . $entry->getTitle() . '</h2>';
	        echo '<p>Date: ' . $entry->getDate() . '</p>';
	        echo '<p>' . $entry->getContent() . '</p>';
	    }
		*/
	    echo '</br>Done</br>';
	}
}