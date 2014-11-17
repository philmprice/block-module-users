<?php

namespace UsersModule\Controller;

class AdminControllerCore extends \Host\Controller\BaseController
{
    public function init()
    {
        //  base init
        parent::init();

        //  build menu
        $menuItemArray  = array();
        $moduleArray    = \Model\Module::find();
        foreach($moduleArray AS $module)
        {
            $menuItemArray[]    = array('label'     => $module->name,
                                        'link'      => ROOT.$module->adminUrl,
                                        'active'    => false);
        }
        $this->view->menuItemArray  = $menuItemArray;
    }

	//	index
    public function indexAction()
    {
    	//	init
    	$this->init();

        //  get users
        $this->view->userArray = \Model\User::find();
    	
		//	set main view
		$this->view->setMainView('block-module-users/admin-index');
    }

    //	create
    public function createAction()
    {
    	//	init
    	$this->init();
    	
        //  if form submitted
        if($this->request->getPost('action') == 'save')
        {
            //  save new user
            $user               = new \Model\User();
            $user->firstName    = $this->request->getPost('firstName',  'string');
            $user->lastName     = $this->request->getPost('lastName',   'string');
            $user->username     = $this->request->getPost('username',   'string');
            $user->password     = $this->request->getPost('password',   'string');
            $user->save();

            //  redirect
            $this->response->redirect(ROOT.'admin/users/', true);
        }
        
		//	set main view
		$this->view->setMainView('block-module-users/admin-create');
    }

    // update
    public function updateAction()
    {
    	//	init
    	$this->init();

        //  get user
        $user               = \Model\User::findFirstById($this->dispatcher->getParam('id'));
        
        //  if form submitted
        if($this->request->getPost('action') == 'save')
        {
            //  save user
            $user->firstName    = $this->request->getPost('firstName',  'string');
            $user->lastName     = $this->request->getPost('lastName',   'string');
            $user->username     = $this->request->getPost('username',   'string');
            $user->password     = $this->request->getPost('password',   'string');
            $user->save();

            //  redirect
            $this->response->redirect(ROOT.'admin/users/', true);
        }
    	
        //  set user
        $this->view->user   = $user;
        
		//	set main view
		$this->view->setMainView('block-module-users/admin-update');
    }

    //	delete
    public function deleteAction()
    {
    	//	init
    	$this->init();
    	
        //  get user
        $user               = \Model\User::findFirstById($this->dispatcher->getParam('id'));
        
        //  if form submitted
        if($this->request->getPost('action') == 'delete')
        {
            //  delete user
            $user->delete();

            //  redirect
            $this->response->redirect(ROOT.'admin/users/', true);
        }
        
        //  set user
        $this->view->user   = $user;
        
		//	set main view
		$this->view->setMainView('block-module-users/admin-delete');
    }
}