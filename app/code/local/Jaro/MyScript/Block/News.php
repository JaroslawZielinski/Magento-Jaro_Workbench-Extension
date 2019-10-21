<?php

/**
 * Class Jaro_MyScript_Block_News
 */
class Jaro_MyScript_Block_News extends Mage_Core_Block_Template
{
    /**
     * Domyślny limit rekordów wyświetlany na stronie
     */
    const DEFAULT_LIMIT = 10;

    /**
     * Przygotuj szablon
     *
     * @return $this
     */
    public function _prepareLayout()
    {
        parent::_prepareLayout();

        $collection = $this->getCustomizedCollection();
        $this->setPagerHtml($collection);

        return $this;
    }

    /**
     * Konfiguruj i ustaw pagincję
     *
     * @param $collection
     * @param int $limit
     */
    protected function setPagerHtml($collection, $limit = self::DEFAULT_LIMIT)
    {
        $pager = $this
            ->getLayout()
            ->createBlock('page/html_pager', 'jaro_myscript_news.pager')
            ->setLimit($limit)
            ->setCollection($collection);

        $this->setChild('pager', $pager);
    }

    /**
     * Zwraca wybraną stronę kolekcji przy ustawionej stronie, limicie i search'u
     *
     * @param array $parameters
     * @return object
     */
    public function getCustomizedCollection(array $parameters = [])
    {
        //wartości domyślne
        if (!isset($parameters['limit'])) {
            $parameters['limit'] = self::DEFAULT_LIMIT;
        }
        if (!isset($parameters['p'])) {
            $parameters['p'] = 1;
        }

        $customerId = null;
        if (Mage::getSingleton('customer/session')->isLoggedIn()) {
            $customer = Mage::getSingleton('customer/session')->getCustomer();
            $customerId = $customer->getId();
        }

        $collection = Mage::getModel('jaro_myscript/news')->getFullDataCollection($customerId);

        if ($this->isSearchAvailable($parameters)) {
            $collection->addFieldToFilter(
                ['name', 'description'],
                [
                    [
                        ['like' => '%' . $parameters['search'] . '%']
                    ],
                    [
                        ['like' => '%' . $parameters['search'] . '%']
                    ]
                ]
            );
        }

        $collection
            ->setCurPage($parameters['p'])
            ->setPageSize($parameters['limit']);

        return $collection;
    }

    /**
     * Zwraca blok Pager
     *
     * @return string
     */
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }

    /**
     * Zwraca link do podglądu wiersza
     *
     * @param $newsItem encja
     * @return string
     */
    public function getViewUrl($newsItem)
    {
        return $this->getUrl('*/*/view', array('id' => $newsItem->getNewsId()));
    }

    /**
     * Zwraca link do strony głownej modułu
     *
     * @return string
     */
    public function getMainUrl()
    {
        return $this->getUrl('jaro_myscript/news');
    }

    /**
     * Zwraca opcję typu tak nie
     *
     * @param int $option (1 or 0)
     * @return string yes/no
     */
    public function getYesNoOption($option)
    {
        $yesNoOptions = Mage::getSingleton('adminhtml/system_config_source_yesno')->toArray();
        return $yesNoOptions[$option ? 1 : 0];
    }

    /**
     * Sprawdza czy jest włączona wyszukiwarka
     *
     * @param array $parameters
     * @return bool
     */
    public function isSearchAvailable(array $parameters)
    {
        return isset($parameters['search']) && !empty($parameters['search']);
    }
}
