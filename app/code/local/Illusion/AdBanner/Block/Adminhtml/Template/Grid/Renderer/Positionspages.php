<?php

class Illusion_AdBanner_Block_Adminhtml_Template_Grid_Renderer_Positionspages extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract{
 
    public function render(Varien_Object $row)
    {        
	$_adbanner_Coll = Mage::getModel('illusion_adbanner/adbanner')->load($row->getId());
	$_statusArr = array('1'=>'Yes','0'=>'No');
	$_returnedHTML = '<table>';
	$_adbanner_Coll = $_adbanner_Coll->getData();
	if(count($_adbanner_Coll) > 0){
        $_returnedHTML .= '<tr><th align="left" colspan="2">Position(s):</th>';
        $_returnedHTML .= '<tr><td align="left">Left Column </td><td align="left">'.$_statusArr[$_adbanner_Coll['position_left']].'</td></tr>';
        $_returnedHTML .= '<tr><td align="left">Content Column </td><td align="left">'.$_statusArr[$_adbanner_Coll['position_content']].'</td></tr>';
        $_returnedHTML .= '<tr><td align="left">Right Column </td><td align="left">'.$_statusArr[$_adbanner_Coll['position_right']].'</td></tr>';
        $_returnedHTML .= '<tr><th align="left" colspan="2">Page(s):</th>';
        $_returnedHTML .= '<tr><td align="left">Home Page </td><td align="left">'.$_statusArr[$_adbanner_Coll['position_home']].'</td></tr>';
        $_returnedHTML .= '<tr><td align="left">Category Page </td><td align="left">'.$_statusArr[$_adbanner_Coll['position_category']].'</td></tr>';
        $_returnedHTML .= '<tr><td align="left">Product Page </td><td align="left">'.$_statusArr[$_adbanner_Coll['position_product']].'</td></tr>';
	}
	
	return $_returnedHTML.'</table>';

    }
}
?>
