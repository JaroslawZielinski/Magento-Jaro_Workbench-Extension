<?php

/**
 * Class Jaro_MyScript_Block_Task1_News_Grid
 */
class Jaro_MyScript_Block_Task1_News_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('grid_id');
        // $this->setDefaultSort('COLUMN_ID');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        /** @var Jaro_MyScript_Model_News $collection */
        $collection = Mage::getModel('jaro_myscript/news')->getFullDataCollection();

        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this
            ->addColumn('id',
                [
                    'header' => $this->__('ID'),
                    'width' => '50px',
                    'index' => 'news_id',
                ])
            ->addColumn('name',
                [
                    'header' => $this->__('Name'),
                    'width' => '300px',
                    'index' => 'name',
                ])
            ->addColumn('description',
                [
                    'header' => $this->__('Description'),
                    'width' => '300px',
                    'index' => 'description',
                ])
            ->addColumn('is_active',
                [
                    'header' => $this->__('Is Active'),
                    'width' => '300px',
                    'index' => 'is_active',
                ])
            ->addColumn('email',
                [
                    'header' => $this->__('Author'),
                    'width' => '300px',
                    'index' => 'email',
                ])
        ;

        $this->addExportType('*/*/exportCsv', $this->__('CSV'));

        $this->addExportType('*/*/exportExcel', $this->__('Excel XML'));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/adminhtml_news/edit', array('id' => $row->getId()));
    }

    protected function _prepareMassaction()
    {
        $modelPk = Mage::getModel('jaro_myscript/news')->getResource()->getIdFieldName();
        $this->setMassactionIdField($modelPk);
        $this->getMassactionBlock()->setFormFieldName('ids');
        // $this->getMassactionBlock()->setUseSelectAll(false);
        $this->getMassactionBlock()->addItem('delete', array(
            'label' => $this->__('Delete'),
            'url' => $this->getUrl('*/*/massDelete'),
        ));
        return $this;
    }
}
