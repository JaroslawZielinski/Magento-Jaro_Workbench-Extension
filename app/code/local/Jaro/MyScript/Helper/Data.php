<?php

/**
 * 
 */
class Jaro_MyScript_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * 
     */
    public function getVersesHelper()
    {
        if (Mage::getStoreConfigFlag('bible/settings/cgi_offline')) {
            return Mage::helper('jaro_myscript/versesOffline');
        } else {
            return Mage::helper('jaro_myscript/verses');
        }
    }
}
