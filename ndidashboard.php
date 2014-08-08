<?php

require_once 'ndidashboard.civix.php';

/**
 * Implementation of hook_civicrm_pageRun
 */
function ndidashboard_civicrm_pageRun() {
    CRM_Core_Resources::singleton()->addStyleFile('com.aghstrategies.ndidashboard', 'css/bootstrap.min.css');
    CRM_Core_Resources::singleton()->addStyleUrl('http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css');
}

/**
 * Implementation of hook_civicrm_pageRun
 */
function ndidashboard_civicrm_defaults($availableDashlets, &$defaultDashlets){
  try{
   $dashlet = civicrm_api3('Dashboard', 'get', array(
      'name'  =>  'contact_per_month',
   ));
}
catch (CiviCRM_API3_Exception $e) {
   $error = $e->getMessage();
}
    $contactID = CRM_Core_Session::singleton()->get('userID');
   $defaultDashlets[] = array(
    'dashboard_id' => $dashlet['id'],
    'is_active' => 1,
    'column_no' => 1,
    'contact_id' => $contactID,
   );
 }


/**
 * Implementation of hook_civicrm_dashboard
 */
function ndidashboard_civicrm_dashboard( $contactID, &$contentPlacement ) {
  $newIndLink = CRM_Utils_System::url('civicrm/contact/add', $query = 'reset=1&ct=Individual' );
  $manageGroupLink = CRM_Utils_System::url('civicrm/group', $query = 'reset=1' );

  $contentPlacement =2;
  return array(
 //'<h2>Welcome</h2>' => "<p>Welcome to your CiviCRM Dashboard<p>",
                  '<h2>Links</h2>' =>
                    "<p>
                    <a href='".$newIndLink."'><button type=\"button\" class=\"btn btn-primary\">Create New Individual</button></a>
                   <a href='".$manageGroupLink."'><button type=\"button\" class=\"btn btn-primary\">Manage Groups</button></a>
                    </p>

                  ",
    );
//  $print = $page->_embedded;
 // print_r($print);
}

/**
 * Implementation of hook_civicrm_config
 */
function ndidashboard_civicrm_config(&$config) {
  _ndidashboard_civix_civicrm_config($config);
}

/**
 * Implementation of hook_civicrm_xmlMenu
 *
 * @param $files array(string)
 */
function ndidashboard_civicrm_xmlMenu(&$files) {
  _ndidashboard_civix_civicrm_xmlMenu($files);
}

/**
 * Implementation of hook_civicrm_install
 */
function ndidashboard_civicrm_install() {
  return _ndidashboard_civix_civicrm_install();
}

/**
 * Implementation of hook_civicrm_uninstall
 */
function ndidashboard_civicrm_uninstall() {
  return _ndidashboard_civix_civicrm_uninstall();
}

/**
 * Implementation of hook_civicrm_enable
 */
function ndidashboard_civicrm_enable() {
  return _ndidashboard_civix_civicrm_enable();
}

/**
 * Implementation of hook_civicrm_disable
 */
function ndidashboard_civicrm_disable() {
  return _ndidashboard_civix_civicrm_disable();
}

/**
 * Implementation of hook_civicrm_upgrade
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed  based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 */
function ndidashboard_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _ndidashboard_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implementation of hook_civicrm_managed
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 */
function ndidashboard_civicrm_managed(&$entities) {
  $entities[] = array(
    'module' => 'com.example.modulename',
    'name' => 'myreport',
    'entity' => 'ReportTemplate',
    'params' => array(
      'version' => 3,
    "domain_id" => "1",
    "name" => "contact_per_month",
    "label" => "Recently Added Contacts",
    "url" => "civicrm/dashlets/contactpermonth&snippet=1",
    "column_no" => "0",
    "is_minimized" => "0",
    "is_fullscreen" => "1",
    "is_active" => "1",
    "is_reserved" => "0",
    "weight" => "0"
    ),
  );}
