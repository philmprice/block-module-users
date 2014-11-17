<?php

namespace UsersModule\Controller;

class PublicControllerCore extends \Host\Controller\BaseController
{
    public function indexAction()
    {
    	//	init
    	$this->init();

    	//	get wines
    	$this->view->userArray = \Model\User::find();
    	
		//	set main view
		$this->view->setMainView('block-module-users/public-index');
    }
}