<?php

class Illusion_Settings_Block_Core_Html_Select extends Mage_Core_Block_Html_Select {

    protected function _toHtml()
    {
        if (!$this->_beforeToHtml()) {
            return '';
        }

        $html = '<div class="selectbox xs_full m_bottom_8"><select name="' . $this->getName() . '" id="' . $this->getId() . '" class="'
            . $this->getClass() . '" title="' . $this->getTitle() . '" ' . $this->getExtraParams() . '>';
        $values = $this->getValue();

        if (!is_array($values)){
            if (!is_null($values)) {
                $values = array($values);
            } else {
                $values = array();
            }
        }

        $isArrayOption = true;
        foreach ($this->getOptions() as $key => $option) {
            if ($isArrayOption && is_array($option)) {
                $value  = $option['value'];
                $label  = (string)$option['label'];
                $params = (!empty($option['params'])) ? $option['params'] : array();
            } else {
                $value = (string)$key;
                $label = (string)$option;
                $isArrayOption = false;
                $params = array();
            }

            if (is_array($value)) {
                $html .= '<optgroup label="' . $label . '">';
                foreach ($value as $keyGroup => $optionGroup) {
                    if (!is_array($optionGroup)) {
                        $optionGroup = array(
                            'value' => $keyGroup,
                            'label' => $optionGroup
                        );
                    }
                    $html .= $this->_optionToHtml(
                        $optionGroup,
                        in_array($optionGroup['value'], $values)
                    );
                }
                $html .= '</optgroup>';
            } else {
                $html .= $this->_optionToHtml(
                    array(
                        'value' => $value,
                        'label' => $label,
                        'params' => $params
                    ),
                    in_array($value, $values)
                );
            }
        }
        $html .= '</select></div>';
        return $html;
    }
}