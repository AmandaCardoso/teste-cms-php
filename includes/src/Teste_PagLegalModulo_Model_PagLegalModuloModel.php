<?php
class Teste_PagLegalModulo_Model_PagLegalModuloModel extends Mage_Payment_Model_Method_Abstract
{
    protected $_code          = 'paglegalmodulo';
    protected $_formBlockType = 'paglegalmodulo/form_pagLegalModuloForm';

    public function assignData($data)
    {
        $info = $this->getInfoInstance();

        if ($data->getCpf())
        {
            $info->setCpf($data->getCpf());
        }

        return $this;
    }

    public function validate()
    {
        parent::validate();
        $info = $this->getInfoInstance();

        if (!$info->getCpf())
        {
            $errorMsg = $this->_getHelper()->__("CPF é obrigatório.\n");
        }else{
            if(!$this->vaildaCpf($info->getCpf())){
                $errorMsg = $this->_getHelper()->__("CPF inválido.\n");
            }
        }

        if ($errorMsg)
        {
            Mage::throwException($errorMsg);
        }

        return $this;
    }

    public function getOrderPlaceRedirectUrl()
    {
        return Mage::getUrl('paglegalmodulo/paglegalmodulo/redirect', array('_secure' => false));
    }

    private function vaildaCpf($cpf){

        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );


        if (strlen($cpf) != 11) {
            return false;
        }

        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf{$c} != $d) {
                return false;
            }
        }
        return true;
    }

}