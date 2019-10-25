<?php
 
class Jaro_MyScript_Model_News extends Jaro_MyScript_Model_Abstract
{

    protected function _construct()
    {
        $this->_init('jaro_myscript/news');
    }

    /**
     * @param null $customerId
     * @return Jaro_MyScript_Model_Mysql4_News_Collection|object
     */
    public function getFullDataCollection($customerId = null)
    {
        $collection =
            $this
                ->getCollection();

        if (!empty($customerId)) {
            $collection->addFieldToFilter('author_id', ['eq' => $customerId]);
        }

        $collection
            ->getSelect()
            ->join([
                'ce' => Mage::getSingleton('core/resource')->getTableName('customer/entity')
            ], 'main_table.author_id=ce.entity_id',
                [
                    'email' => 'ce.email'
                ]);

        return $collection;
    }

    /**
     * @param $newsId
     * @param null $customerId
     * @return Varien_Object
     */
    public function getNewsByNewsId($newsId, $customerId = null)
    {
        $collection = $this->getFullDataCollection($customerId);
        $collection->addFieldToFilter('news_id', ['eq' => $newsId]);

        return $collection->getFirstItem();
    }
}