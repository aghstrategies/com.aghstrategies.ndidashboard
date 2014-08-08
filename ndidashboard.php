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
function ndidashboard_civicrm_dashboard_defaults($availableDashlets, &$defaultDashlets){
$contactID = CRM_Core_Session::singleton()->get('userID');
  try{
   $dashlet = civicrm_api3('DashboardContacat', 'getSingle', array(
      'dashboard_id'  =>  $availableDashlets['contact_per_month']['id'],
      'contact_id' => $contactID,
   ));
}
catch (CiviCRM_API3_Exception $e) {
   $error = $e->getMessage();
}

// $defaultDashlets[] = array(
//   'id' => $dashlet['id'],
//     "dashboard_id" => $availableDashlets['contact_per_month']['id'],
//     "contact_id" => $contactID,
//     "column_no" => "1",
// // //     "is_minimized" => "0",
// // //     "is_fullscreen" => "1",
//     "is_active" => "1",
// //     "weight" => "0",
   // );
 }

/**
 * Implementation of hook_civicrm_dashboard
 */
function ndidashboard_civicrm_dashboard( $contactID, &$contentPlacement ) {
//   try{
//    $dashlet = civicrm_api3('Dashboard', 'getSingle', array(
//       'name'  =>  'contact_per_month',
//    ));
//   }
//   catch (CiviCRM_API3_Exception $e) {
//      $error = $e->getMessage();
//   }
//   $contactID = CRM_Core_Session::singleton()->get('userID');
//     try{
//    $contactDashlet = civicrm_api3('DashboardContact', 'getSingle', array(
//       'dashboard_id'  =>  $dashlet['id'],
//       'contact_id' => $contactID,
//    ));
// }
// catch (CiviCRM_API3_Exception $e) {
//    $error = $e->getMessage();
// }

  // $params = array(
  //   "id" => $contactDashlet['id'],
  //   "contact_id" => $contactID,
  //   "column_no" => "1",
  //   "dashboard_id" => $dashlet['id'],
  //   // "is_minimized" => "0",
  //   // "is_fullscreen" => "1",
  //   "is_active" => "1",
  //   // "weight" => "0",
  //   );
  // civicrm_api3('DashboardContact', 'Create', $params);
  // $params = array(
  //   "dashboard_id" => 2,
  //   "contact_id" => $contactID,
  //   "column_no" => "0",
  //   "is_minimized" => "0",
  //   "is_fullscreen" => "1",
  //   "is_active" => "1",
  //   "weight" => "0",
  //   );
  // civicrm_api3('DashboardContact', 'Create', $params);

  //Communication
  $sendMailing = CRM_Utils_System::url('civicrm/mailing/send', $query = 'reset=1' );

  //Manage Contacts
  $newIndLink = CRM_Utils_System::url('civicrm/contact/add', $query = 'reset=1&ct=Individual' );
  $browseContacts = CRM_Utils_System::url('civicrm/contact/search', $query = 'reset=1&force=1' );
  $manageGroupLink = CRM_Utils_System::url('civicrm/group', $query = 'reset=1' );
  $viewAllReports = CRM_Utils_System::url('civicrm/report/list', $query = 'reset=1' );

  //Manage Events
  $newEvent = CRM_Utils_System::url('civicrm/event/add', $query = 'reset=1&action=add' );
  $manageEvents = CRM_Utils_System::url('civicrm/event/manage', $query = 'reset=1' );
  $searchParticipants = CRM_Utils_System::url('civicrm/event/search', $query = 'reset=1' );
  $registerParticipant = CRM_Utils_System::url('civicrm/participant/add', $query = 'reset=1&action=add&context=standalone' );
  $scheduleReminder = CRM_Utils_System::url('civicrm/admin/scheduleReminders', $query = 'reset=1' );




  $contentPlacement =2;
  return array(
 //'<h2>Welcome</h2>' => "<p>Welcome to your CiviCRM Dashboard<p>",

                  '<h2>Contacts</h2>' =>
                    "<p>
                    <a href='".$newIndLink."'><button type=\"button\" class=\"btn btn-primary\">Create New Individual</button></a>
                    <a href='".$browseContacts."'><button type=\"button\" class=\"btn btn-primary\">Browse Contacts</button></a>
                   <a href='".$manageGroupLink."'><button type=\"button\" class=\"btn btn-primary\">Manage Groups</button></a>
                    <a href='".$viewAllReports."'><button type=\"button\" class=\"btn btn-primary\">View All Reports</button></a>
                    <a href='".$sendMailing."'><button type=\"button\" class=\"btn btn-primary\">Send Mailing</button></a>
                    </p>
                  ",
                  '<h2>Events</h2>' =>
                    "<p>
                    <a href='".$newIndLink."'><button type=\"button\" class=\"btn btn-success\">Organize Event</button></a>
                    <a href='".$manageEvents."'><button type=\"button\" class=\"btn btn-success\">All Events</button></a>
                   <a href='".$searchParticipants."'><button type=\"button\" class=\"btn btn-success\">Search Participants</button></a>
                    <a href='".$registerParticipant."'><button type=\"button\" class=\"btn btn-success\">Register Participant</button></a>
                      <a href='".$scheduleReminder."'><button type=\"button\" class=\"btn btn-success\">Schedule Reminder</button></a>
                  </p>
                  ",
    );
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
    'module' => 'com.aghstrategies.ndidashboard',
    'name' => 'contactpermonth',
    'entity' => 'Dashboard',
    'params' => array(
      'version' => 3,
    "domain_id" => "1",
    "name" => "contact_per_month",
    "label" => "Recently Added",
    "url" => "civicrm/dashlets/contactpermonth&snippet=1",
    "column_no" => "0",
    "is_minimized" => "0",
    "is_fullscreen" => "1",
    "is_active" => "1",
    "is_reserved" => "1",
    "weight" => "0"
    ),
  );
  // try{
  //   $ufMatches = civicrm_api3('UFMatch', 'get', array());
  // }
  // foreach ($ufMatches as $ufMatch){

  // }
}
