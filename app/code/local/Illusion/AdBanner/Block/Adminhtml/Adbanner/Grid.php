<?php

class Illusion_AdBanner_Block_Adminhtml_Adbanner_Grid extends Mage_Adminhtml_Block_Widget_Grid{

    /**
     *
     */
    public function __construct(){
        parent::__construct();
        $this->setId('adbannerGrid');
        $this->setDefaultSort('adbanner_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }

    /**
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareCollection(){
        $collection = Mage::getModel('illusion_adbanner/adbanner')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * @return $this
     */
    protected function _prepareColumns(){
        $this->addColumn('adbanner_id', array(
            'header'    => Mage::helper('illusion_adbanner')->__('ID'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'adbanner_id',
        ));

        $this->addColumn('title', array(
            'header'    => Mage::helper('illusion_adbanner')->__('Title'),
            'align'     =>'left',
            'index'     => 'title',
        ));

        $this->addColumn('advmode', array(
            'header'    => Mage::helper('illusion_adbanner')->__('Mode'),
            'align'     =>'left',
            'index'     => 'advmode',
            'type'      => 'options',
            'options'   => array(
                0 => 'Code',
                1 => 'Image',
            ),
        ));

        $this->addColumn( 'image', array(
            'header' => Mage::helper('illusion_adbanner')->__('Image'),
            'type' => 'image',
            'width' => '150px',
            'index' => 'image',
            'filter'    => false,
            'sortable'  => false,
            'renderer' => 'illusion_adbanner/adminhtml_template_grid_renderer_image',
        ));

        $this->addColumn('positionspages', array(
            'header'    => Mage::helper('illusion_adbanner')->__('Positions/Pages'),
            'width'     => '150px',
            'align'     =>'center',
            'index'     => 'adbanner_id',
            'renderer'  => 'illusion_adbanner/adminhtml_template_grid_renderer_positionspages',
            'inlinecss' => 'style="width:100px; border:1px solid #000;"',
            'filter'    => false,
            'sortable'  => false,
        ));


        $this->addColumn('status', array(
            'header'    => Mage::helper('illusion_adbanner')->__('Status'),
            'align'     => 'left',
            'width'     => '80px',
            'index'     => 'status',
            'type'      => 'options',
            'options'   => array(
                1 => 'Enabled',
                2 => 'Disabled',
            ),
        ));
		
        $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('illusion_adbanner')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('illusion_adbanner')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
            ));

        $this->addExportType('*/*/exportCsv', Mage::helper('illusion_adbanner')->__('CSV'));
        $this->addExportType('*/*/exportXml', Mage::helper('illusion_adbanner')->__('XML'));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('adbanner_id');
        $this->getMassactionBlock()->setFormFieldName('illusion_adbanner');

        $this->getMassactionBlock()->addItem('delete', array(
            'label'    => Mage::helper('illusion_adbanner')->__('Delete'),
            'url'      => $this->getUrl('*/*/massDelete'),
            'confirm'  => Mage::helper('illusion_adbanner')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('illusion_adbanner/status')->getOptionArray();

        array_unshift($statuses, array('label'=>'', 'value'=>''));
        $this->getMassactionBlock()->addItem('status', array(
            'label'=> Mage::helper('illusion_adbanner')->__('Change status'),
            'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
            'additional' => array(
                'visibility' => array(
                    'name' => 'status',
                    'type' => 'select',
                    'class' => 'required-entry',
                    'label' => Mage::helper('illusion_adbanner')->__('Status'),
                    'values' => $statuses
                )
            )
        ));
        return $this;
    }

    /**
     * @param $row
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }


}