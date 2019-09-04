<?php

/**
 *
 */
class Jaro_MyScript_Helper_Content extends Mage_Core_Helper_Abstract
{
    /**
     *
     * @param integer $versesId
     * @return type
     */
    protected function _getLinkedSingleVerses($versesId)
    {
        /** @var Jaro_MyScript_Model_Verses $verses */
        $verses = Mage::getModel('jaro_myscript/verses')->load($versesId);
        $linkedVerses = Mage::getSingleton('jaro_myscript/verses')
            ->getCollection()
            ->addFieldToFilter('parent_id', ['eq' => $verses->getId()]);

        $result = [
            'content' => trim($verses->getContent()),
            'sigla' => Mage::helper('jaro_myscript')->getVersesHelper()->getExtendedSiglaByVerse($verses),
            'list' => null
        ];

        foreach ($linkedVerses as $linkedVerse) {
            $result['list'][] = $this->_getLinkedSingleVerses($linkedVerse->getId());
        }

        return $result;
    }

    /**
     *
     * @param type $id
     * @return type
     */
    public function prepareContent($id)
    {
        /** @var Jaro_MyScript_Model_Teachings $teaching */
        $teaching = Mage::getModel('jaro_myscript/teachings')->load($id);

        $verseId = $teaching->getVerseId();
        $verse = Mage::getModel('jaro_myscript/verses')
            ->load($verseId);

        return [
            'name' => $teaching->getName(),
            'title' => Mage::helper('jaro_myscript')->getVersesHelper()->getShortenedSiglaByVerse($verse),
            'document' => $this->_getLinkedSingleVerses($teaching->getVerseId()),
        ];
    }
}
