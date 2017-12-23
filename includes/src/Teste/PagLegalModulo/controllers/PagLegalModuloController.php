<?php
class Teste_PagLegalModulo_PagLegalModuloController extends Mage_Core_Controller_Front_Action
{

    public function redirectAction()
    {
        $this->loadLayout();
        $block = $this->getLayout()->createBlock('Mage_Core_Block_Template','paglegalmodulo',array('template' => 'paglegalmodulo/telasucesso.phtml'));
        $this->getLayout()->getBlock('content')->append($block);
        $this->renderLayout();
    }

}