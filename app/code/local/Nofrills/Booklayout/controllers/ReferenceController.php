<?php
	class Nofrills_Booklayout_ReferenceController extends Mage_Core_Controller_Front_Action
	{
	
		/**
		* Use to set the base page structure
		*/	
		protected function _initLayout()
		{
			$path_page = Mage::getModuleDir('', 'Nofrills_Booklayout') . DS . 
			'page-layouts' . DS . 'page.xml';					
			$xml = file_get_contents($path_page); 	
			$layout = Mage::getSingleton('core/layout')
			->getUpdate()
			->addUpdate($xml);			
		}

		/**
		* Use to send output 
		*/		
		protected function _sendOutput()
		{
			$layout = Mage::getSingleton('core/layout');
			
			$layout->generateXml()
			->generateBlocks();
			
			echo $layout->setDirectOutput(false)->getOutput();
		}
		
		
		public function indexAction()
		{
			$this->_initLayout();
			  Mage::getSingleton('core/layout')
    ->getUpdate()
    ->addUpdate('<reference name="content">
        <block type="core/text" name="our_message">
            <action method="setText"><text>Here we go!</text></action>
        </block>
    </reference>');
			$this->_sendOutput();
			//Otra prueba
			
			//Es la prueba de Git
		}				
	}