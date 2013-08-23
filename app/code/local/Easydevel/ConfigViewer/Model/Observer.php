<?php
    class Easydevel_ConfigViewer_Model_Observer {
        const FLAG_SHOW_CONFIG = 'showConfig';
        const FLAG_SHOW_CONFIG_FORMAT = 'showConfigFormat';

        private $request;

        public function checkForConfigRequest($observer) {
        	Mage::log("Toy en checkforconfigrequest");
            $this->request = $observer->getEvent()->getData('front')->getRequest();
            Mage::log(">>>>>".self::FLAG_SHOW_CONFIG."<<<<<");
            Mage::log(">>>>>".$this->request->{self::FLAG_SHOW_CONFIG}."<<<<<");
            if($this->request->{self::FLAG_SHOW_CONFIG} === 'true'){
                Mage::log("Ini Escribo cabeceras");
            	$this->setHeader();
                $this->outputConfig();
            	Mage::log("Fin Escribo cabeceras");
            }
            Mage::log("No Toy en checkforconfigrequest");
        }

        private function setHeader() {
            $format = isset($this->request->{self::FLAG_SHOW_CONFIG_FORMAT}) ?
            $this->request->{self::FLAG_SHOW_CONFIG_FORMAT} : 'xml';
            Mage::log(">>>>>".$format."<<<<<");
            switch($format){
                case 'text':
                    header("Content-Type: text/plain");
                    break;
                default:
                    header("Content-Type: text/xml");
            }
        }

        private function outputConfig() {
        	
            die(Mage::app()->getConfig()->getNode()->asXML());
        }
    }