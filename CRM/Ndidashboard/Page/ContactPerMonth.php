<?php

require_once 'CRM/Core/Page.php';

class CRM_Ndidashboard_Page_ContactPerMonth extends CRM_Core_Page {
  function run() {
    $sql = "SELECT count(id) as createdthismonth FROM civicrm_contact WHERE MONTH(created_date) = MONTH(CURRENT_DATE ) AND YEAR(created_date) = YEAR(CURRENT_DATE);";
    $dao = CRM_Core_DAO::executeQuery($sql);
    if ($dao->fetch()){
      $createdthismonth = $dao->createdthismonth;
    }
    $this->assign('createdThisMonth', $createdthismonth);
    $sql = "SELECT count(id) as createdlastmonth FROM civicrm_contact WHERE MONTH(created_date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) AND YEAR(created_date - INTERVAL 1 MONTH) = YEAR(CURRENT_DATE);";
    $dao = CRM_Core_DAO::executeQuery($sql);
    if ($dao->fetch()){
      $createdlastmonth = $dao->createdlastmonth;
    }
    $this->assign('createdLastMonth', $createdlastmonth);

    // Example: Set the page-title dynamically; alternatively, declare a static title in xml/Menu/*.xml
    CRM_Utils_System::setTitle(ts('ContactPerMonth'));

    // Example: Assign a variable for use in a template
    $this->assign('currentTime', date('Y-m-d H:i:s'));

    parent::run();
  }
}
