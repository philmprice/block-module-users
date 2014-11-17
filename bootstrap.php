<?php

$blockVendor		= "philmprice";									//	github vendor name
$blockFolder        = "block-module-users";							//	github project name (must start with 'block-module-')
$blockHandle		= str_replace('block-module-','',$blockFolder);
$blockUpperHandle	= handle2upperHandle($blockHandle);								
$blockNamespace		= $blockUpperHandle.'Module';

////////////////////////////
//  ROUTES

//  index
$indexControllerData = array(
    'controller'    => 'admin',
    'action'        => 'index',
    'namespace'     => $blockNamespace.'\Controller'
);
$router->add("/admin/".$blockHandle,                        $indexControllerData);
$router->add("/admin/".$blockHandle."/",                    $indexControllerData);

//  create
$indexControllerData = array(
    'controller'    => 'admin',
    'action'        => 'create',
    'namespace'     => $blockNamespace.'\Controller'
);
$router->add("/admin/".$blockHandle."/create",              $indexControllerData);
$router->add("/admin/".$blockHandle."/create/",             $indexControllerData);

//  update
$indexControllerData = array(
    'controller'    => 'admin',
    'action'        => 'update',
    'namespace'     => $blockNamespace.'\Controller'
);
$router->add("/admin/".$blockHandle."/update/{id}",         $indexControllerData);
$router->add("/admin/".$blockHandle."/update/{id}/",        $indexControllerData);

//  delete
$indexControllerData = array(
    'controller'    => 'admin',
    'action'        => 'delete',
    'namespace'     => $blockNamespace.'\Controller'
);
$router->add("/admin/".$blockHandle."/delete/{id}",         $indexControllerData);
$router->add("/admin/".$blockHandle."/delete/{id}/",        $indexControllerData);

// public website
$indexControllerData = array(
    'controller'    => 'public',
    'action'        => 'index',
    'namespace'     => $blockNamespace.'\Controller'
);
$router->add("/".$blockHandle,      $indexControllerData);
$router->add("/".$blockHandle."/",  $indexControllerData);

////////////////////////////
//  CLASSES

$loaderClassArray[$blockNamespace.'\Controller\AdminControllerCore']    = ABS_ROOT.CORE_FOLDER.'/'.$blockAuthor.'/'.$blockFolder.'/controllers/AdminControllerCore.php';
$loaderClassArray[$blockNamespace.'\Controller\AdminController']        = ABS_ROOT.PROJ_FOLDER.'/'.$blockAuthor.'/'.$blockFolder.'/controllers/AdminController.php';

$loaderClassArray[$blockNamespace.'\Controller\PublicControllerCore']   = ABS_ROOT.CORE_FOLDER.'/'.$blockAuthor.'/'.$blockFolder.'/controllers/PublicControllerCore.php';
$loaderClassArray[$blockNamespace.'\Controller\PublicController']       = ABS_ROOT.PROJ_FOLDER.'/'.$blockAuthor.'/'.$blockFolder.'/controllers/PublicController.php';

$loaderClassArray['Model\UserCore']										= ABS_ROOT.CORE_FOLDER.'/'.$blockAuthor.'/'.$blockFolder.'/models/UserCore.php';
$loaderClassArray['Model\User']											= ABS_ROOT.PROJ_FOLDER.'/'.$blockAuthor.'/'.$blockFolder.'/models/User.php';

////////////////////////////
//  AUTOLOAD FOLDERS

$loaderDirArray[]   = '../../'.$blockFolder.'/models/';
$loaderDirArray[]   = '../../'.$blockFolder.'/php/objects/';

////////////////////////////
//  AUTOLOAD NAMESPACES

// $loaderNamespaceArray['BlockModule\Pages']	= "../../".$blockFolder."/php/objects/";

////////////////////////////
//  REFRESH
if(SERVER == 'dev' && isset($_GET['refreshAll']))
{
    ////////////////////////////
    //  REGISTER MENU ITEM

    $moduleData = array('uid'       => 'proto-users',
                        'name'      => 'Users',
                        'adminUrl'  => 'admin/users/',
                        'publicUrl' => 'users/');
    \Model\Module::register($moduleData);
}