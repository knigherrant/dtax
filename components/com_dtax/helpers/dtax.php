<?php

/**
 * @version    CVS: 1.0.0
 * @package    Com_DTax
 * @author     Joomlavi <info@joomlavi.com>
 * @copyright  2016 Joomlavi
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

/**
 * Class frontend
 *
 * @since  1.6
 */

require_once JPATH_ADMINISTRATOR.'/components/com_dtax/helpers/dtax.php';
class JST extends jSont{
    
   
    
    public static function profile($userid = 0){
        if(!$userid) $userid = JFactory::getUser ()->id;
        if(!$userid) return false;
    }
    
    
    public static function getCompanyInfo($userid = 0){
        if(!$userid) $userid = JFactory::getUser ()->id;
        if(!$userid) return false;
        if($company = self::isCompany($userid)) return $company;
        if($office = self::isOffice($userid)){
            $officeParent = self::getParentOffice($userid);
            $company = self::isCompany($officeParent->userid);
            return $company;
        }
        if($employee = self::isEmployee($userid)){
            if($employee->company_id) $company = self::getCompanyById($employee->company_id);
            else if($employee->office_id){
                $office = self::getOfficeById($employee->office_id);
                $officeParent = self::getParentOffice($office->userid);
                $company = self::isCompany($officeParent->userid);
            }
            return $company;
        }    
       return false;
    }
    
    public static function getCompanyById($id = 0){
        static $company;
        if(!isset($company[$id])){
            $db = JFactory::getDbo();
            $company[$id] = $db->setQuery('SELECT * FROM #__dtax_comany WHERE id=' . $id)->loadObject();
        }
        return $company[$id];
    }
    
    public static function getOfficeById($id = 0){
        static $ofice;
        if(!isset($ofice[$id])){
            $db = JFactory::getDbo();
            $ofice[$id] = $db->setQuery('SELECT * FROM #__dtax_locations WHERE id=' . $id)->loadObject();
        }
        return $ofice[$id];
    }
    
    public static function getParentOffice($userid = 0){
        
    }
    
    public static function isEmployee($userid = 0){
        if(!$userid) $userid = JFactory::getUser ()->id;
        if(!$userid) return false;
        static $employee;
        if(!isset($employee[$userid])){
            $db = JFactory::getDbo();
            $employee[$userid] = $db->setQuery('SELECT * FROM #__dtax_employees WHERE userid=' . $userid)->loadObject();
            if($employee[$userid]){
                //if(!$office[$userid]->logo) $office[$userid]->logo = JUri::root () . 'components/com_dtax/assets/images/no_logo.png';
            }
        }
        return $employee[$userid];
    }
    
    public static function isOffice($userid = 0){
        if(!$userid) $userid = JFactory::getUser ()->id;
        if(!$userid) return false;
        static $office;
        if(!isset($office[$userid])){
            $db = JFactory::getDbo();
            $office[$userid] = $db->setQuery('SELECT * FROM #__dtax_locations WHERE userid=' . $userid)->loadObject();
            if($office[$userid]){
                //if(!$office[$userid]->logo) $office[$userid]->logo = JUri::root () . 'components/com_dtax/assets/images/no_logo.png';
            }
        }
        return $office[$userid];
    }
    
    public static function toolbar($task = '',$bnt = ''){
        if(!$task) return;
            ?>
            <div id="btn-toolbar" class="btn-toolbar">
                <?php if($bnt && $task=='appointment'){ ?>
                    <button onclick="Joomla.submitbutton('<?php echo $task; ?>.add')" class="btn btn-small btn-success">
                        <span class="icon-new icon-white"></span> New
                    </button>
                <?php }else if($bnt){ ?>
                    <button onclick="Joomla.submitbutton('<?php echo $task; ?>.add')" class="btn btn-small btn-success">
                        <span class="icon-new icon-white"></span> New
                    </button>
                    <button onclick="if (document.adminForm.boxchecked.value==0){alert('Please first make a selection from the list.');}else{ Joomla.submitbutton('<?php echo $task; ?>s.delete')}" class="btn btn-small">
                        <span class="icon-delete"></span> Delete
                    </button>
                <?php } else if($task == 'location' || $task == 'locations'){ ?>
                  
                    <button type="button" class="btn btn-primary" onclick="Joomla.submitbutton('<?php echo $task;?>.apply')">
                            <span class="icon-ok"></span><?php echo JText::_('JSAVE') ?>
                    </button>
                    <button onclick="Joomla.submitbutton('<?php echo $task; ?>.add')" class="btn btn-small btn-success">
                        <span class="icon-new icon-white"></span> New
                    </button>
                <?php } else if($task == 'view'){ ?>
                   <div class="btn-group">
                            <button type="button" class="btn" onclick="Joomla.submitbutton('email.cancel')">
                                    <span class="icon-cancel"></span><?php echo JText::_('Close') ?>
                            </button>
                    </div>
                <?php } else{ ?>
                    <div class="btn-group">
                            <button type="button" class="btn btn-primary" onclick="Joomla.submitbutton('<?php echo $task;?>.save')">
                                    <span class="icon-ok"></span><?php echo JText::_('JSAVE') ?>
                            </button>
                    </div>
                    <?php if($task !=='locations' && $task !=='customer'){ ?>
                    <div class="btn-group">
                            <button type="button" class="btn" onclick="Joomla.submitbutton('<?php echo $task;?>.cancel')">
                                    <span class="icon-cancel"></span><?php echo JText::_('JCANCEL') ?>
                            </button>
                    </div>
                    <?php } ?>
                <?php } ?>
            </div>
            <?php
        }
        
   
        
    public static function dtaxLeft(){
        $input = JFactory::getApplication()->input;
        $Itemid = $input->getInt('Itemid', 0);
        $view = $input->getString('view', '');
        $pageOffice = array('locations','location', 'employee','employees');
        $pageAppoint = array('appointments','appointment');
        $pageLatest = array('email','emails', 'taxreturns','taxreturn');
        if(in_array($view, $pageOffice)){
            echo self::listLeftOffices();
        }
        if(in_array($view, $pageAppoint)){
            echo self::listLeftAppointments();
        }
        if(in_array($view, $pageLatest)){
            echo self::listLeftTaxReturns();
        }
    }    
    
    public static function listLeftTaxReturns(){
        $userid = JFactory::getUser()->id;
        
        $taxreturn = self::getTaxReturn($userid, 500);
        
        $input = JFactory::getApplication()->input;
        $Itemid = $input->getInt('Itemid', 0);
        ob_start();
        ?>
        <div class="list-left dtax-taxreturn">
            <?php foreach ($taxreturn as $f){ 
                $taxpayer = $f->tax_firstname . ' ' . $f->tax_midname . ' ' . $f->tax_lastname;
            ?>
            <p class="jItem">
                <a href="<?php echo JRoute::_('index.php?option=com_dtax&task=taxreturn.edit&id='.(int) $f->id . '&Itemid='. $Itemid); ?>">
                    <?php echo $taxpayer; ?>
                </a>
                <span data-id="<?php echo $f->id; ?>" data-action="taxreturns" class="icon-trash"></span>
            </p>
            <?php } ?>
        </div>
        <?php
        return ob_get_clean();
    }
    
    public static function listLeftAppointments(){
        $userid = JFactory::getUser()->id;
        $appoints = self::getAppoint($userid, 100);
        $input = JFactory::getApplication()->input;
        $Itemid = $input->getInt('Itemid', 0);
        ob_start();
        ?>
        <div class="list-left dtax-offices">
            <?php foreach ($appoints as $f){ ?>
            <p class="jItem">
                <a href="<?php echo JRoute::_('index.php?option=com_dtax&task=appointment.edit&id='.(int) $f->id . '&Itemid='. $Itemid); ?>">
                    <span><?php echo $f->apptime; ?></span> - <?php echo $f->taxpayer; ?>
                </a>
                <span data-id="<?php echo $f->id; ?>" data-action="appointments" class="icon-trash"></span>
            </p>
            <?php } ?>
        </div>
        <?php
        return ob_get_clean();
    }
    
    public static function listLeftOffices(){
        $userid = JFactory::getUser()->id;
        $office = self::getLocation($userid, 100);
        $input = JFactory::getApplication()->input;
        $Itemid = $input->getInt('Itemid', 0);
        ob_start();
        ?>
        <div class="list-left dtax-offices">
            <?php foreach ($office as $f){ ?>
            <p class="jItem">
                <a href="<?php echo JRoute::_('index.php?option=com_dtax&task=location.edit&id='.(int) $f->id. '&Itemid='. $Itemid); ?>">
                    <?php echo $f->address; ?>
                </a>
                <span data-id="<?php echo $f->id; ?>" data-action="locations" class="icon-trash"></span>
            </p>
            <?php } ?>
        </div>
        <?php
        return ob_get_clean();
    }
    
    public static function isCom(){
        return true;
    }
    
    
    public static function Menu($view = ''){
        
        $input = JFactory::getApplication()->input;
        $Itemid = $input->getInt('Itemid', 0);
        if(!$view) $view = $input->getString('view', 'frontend');
        $customers = array('customers','customer','invoices','invoice','expenses','expense','receipts','receipt','mileages','mileage');
        ob_start();
        ?>
        <div id="menu">
            <ul>
                <li class="homepage <?php if($view=='homepage') echo 'active';?>"><a href="<?php echo JRoute::_('index.php?option=com_dtax&view=homepage&Itemid='.$Itemid); ?>"><?php echo JText::_('Home'); ?></a></li>
                <?php if(jSont::isCompany()){ ?>
                    <li class="profiles <?php if($view=='dtax') echo 'active';?>"><a href="<?php echo JRoute::_('index.php?option=com_dtax&view=dtax&Itemid='.$Itemid); ?>"><?php echo JText::_('Profile'); ?></a></li>
                    <li class="customers <?php if(in_array($view, $customers)) echo 'active';?>"><a href="<?php echo JRoute::_('index.php?option=com_dtax&view=customers&Itemid='.$Itemid); ?>"><?php echo JText::_('Customers'); ?></a></li>
                    <li class="taxreturns <?php if($view=='taxreturns' || $view=='taxreturn') echo 'active';?>"><a href="<?php echo JRoute::_('index.php?option=com_dtax&view=taxreturns&Itemid='.$Itemid); ?>"><?php echo JText::_('Tax Returns'); ?></a></li>
                <?php }else if(jSont::isCustomer()){ ?>
                    <li class="customer <?php if($view=='customer') echo 'active';?>"><a href="<?php echo JRoute::_('index.php?option=com_dtax&view=customer&Itemid='.$Itemid); ?>"><?php echo JText::_('Profile'); ?></a></li>
                    <li class="expenses <?php if($view=='expenses' || $view=='expense') echo 'active';?>"><a href="<?php echo JRoute::_('index.php?option=com_dtax&view=expenses&Itemid='.$Itemid); ?>"><?php echo JText::_('Expenses'); ?></a></li>
                    <li class="receipts <?php if($view=='receipts' || $view=='receipt') echo 'active';?>"><a href="<?php echo JRoute::_('index.php?option=com_dtax&view=receipts&Itemid='.$Itemid); ?>"><?php echo JText::_('Rreceipts'); ?></a></li>
                    <li class="mileages <?php if($view=='mileages' || $view=='mileage') echo 'active';?>"><a href="<?php echo JRoute::_('index.php?option=com_dtax&view=mileages&Itemid='.$Itemid); ?>"><?php echo JText::_('Mileages'); ?></a></li>
                    <li class="taxreturns <?php if($view=='taxreturns' || $view=='taxreturn') echo 'active';?>"><a href="<?php echo JRoute::_('index.php?option=com_dtax&view=taxreturns&Itemid='.$Itemid); ?>"><?php echo JText::_('File Returns'); ?></a></li>
                <?php } ?>
            </ul>
        </div>
        <?php
        return ob_get_clean();
    }
    
    
     public static function logo(){
        $input = JFactory::getApplication()->input;
        $Itemid = $input->getInt('Itemid', 0);
        ob_start();
        $homepage = JRoute::_('index.php?option=com_dtax&view=homepage&Itemid='.$Itemid);
        if($company = self::isCompany()){
            
            ?>
            <div class="hleft">
                <a id="logo" title="<?php echo $company->company; ?>" href="<?php echo $homepage; ?>">
                    <img alt="<?php echo $company->company; ?>" src="<?php echo $company->logo; ?>" />
                </a>
            </div>
            <div class="hright">
                <a class="ichome" href="<?php echo $homepage; ?>">
                    <img alt="<?php echo $company->company; ?>" src="<?php echo JUri::root(); ?>components/com_dtax/assets/images/icon-home.png" />
                </a>
                <a class="iclogout" class="jk-logout" href="javascript:void(0)">
                    <img alt="<?php echo $company->company; ?>" src="<?php echo JUri::root(); ?>components/com_dtax/assets/images/icon-logout.png" />
                </a>
                <form id="jkLogout" action="<?php echo JRoute::_('index.php?option=com_users&task=user.logout'); ?>" method="post">
                        <input type="hidden" name="return" value="<?php echo base64_encode('index.php?option=com_users&view=login'); ?>" />
                        <input type="hidden" name="option" value="com_users" />
                        <input type="hidden" name="task" value="user.logout" />
                        <?php echo JHtml::_('form.token'); ?>
                </form>
                <script> jQuery(function($){  $('a.jk-logout').click(function(){  $('#jkLogout').submit();  return false;  }); }) </script>
                
            </div>
            <?php
            
        }
        return ob_get_clean();
    }
    
    
    public static function isHome(){
        $view = JFactory::getApplication()->input->getString('view');
        return $view == 'homepage';
    }
    
    public static function header(){
        if(self::isCom()){
            echo '<div id="dtaxMain" class="">';
            echo '<div id="dtaxHeader">' . self::logo() . '</div>';
            echo '<div class="jMain">';
            if(!self::isHome()){
                echo '<div id="dtaxLeft" class="span3">';
                echo self::dtaxLeft();
                echo '</div>';
                echo '<div id="mainContent" class="span9">';
            }else{
                echo '<div id="mainContent" class="">';
            }
        }
    }
    
    public static function footer(){
        if(self::isCom()){
            echo '</div></div></div>';
        }
    }
    
    public static function tabsMenuOfice($v =''){
        $input = JFactory::getApplication()->input;
        $Itemid = $input->getInt('Itemid', 0);
        if(!$v) $v = $input->getString('view');
        ?>
        <ul class="nav nav-tabs" id="myTabTabs">
            <li class="<?php if($v == 'location' || $v =='locations') echo 'active'; ?>"><a  href="<?php echo JRoute::_('index.php?option=com_dtax&view=locations&Itemid='.$Itemid); ?>" >Office(s)</a></li>
            <li class="<?php if($v == 'employee' || $v =='employees') echo 'active'; ?>"><a  href="<?php echo JRoute::_('index.php?option=com_dtax&view=employees&Itemid='.$Itemid); ?>"  >Employee(s)</a></li>         
        </ul>
        <?php
    }
    
    public static function tabsMenuAppoint($v =''){
        $input = JFactory::getApplication()->input;
        $Itemid = $input->getInt('Itemid', 0);
        if(!$v) $v = $input->getString('view');
        ?>
        <ul class="nav nav-tabs" id="myTabTabs">
            <li class="<?php if($v == 'appointments' || $v =='appointment') echo 'active'; ?>"><a  href="<?php echo JRoute::_('index.php?option=com_dtax&view=appointments&Itemid='.$Itemid); ?>" >Appointments</a></li>
        </ul>
        <?php
    }
    
    public static function tabActive($link, $text){
        ?>
        <ul class="nav nav-tabs" id="myTabTabs">
            <li class="active"><a href="<?php echo JST::getLink($link); ?>"><?php echo $text; ?></a></li>
        </ul>
        <?php
    }
    
    public static function where($t = ''){
        $userid = JFactory::getUser ()->id;
        $where = '';
        if($t){
            $where .= " WHERE $t.created_by IN (" .$userid . ")";
        }else{
            $where .= ' WHERE created_by IN (' .$userid . ')';
        }
        return $where;
    }
    
    public static function end($t = ''){
        $userid = JFactory::getUser ()->id;
        $where = '';
        if($t){
            $where .= ' AND t.created_by IN (' .$userid . ')';
        }else{
            $where .= ' AND created_by IN (' .$userid . ')';
        }
        return $where;
    }
    
    public static function dbwhere(&$db, $t=''){
        
    }
    
    public static function getLocation($userid = null, $limit = 2){
        if(!$userid) $userid = JFactory::getUser ()->id;
        if(!$userid) return false;
        static $location;
        if(!isset($location[$userid])){
            $db = JFactory::getDbo();
            $location[$userid] = $db->setQuery('SELECT * FROM #__dtax_locations' . self::where() . ' LIMIT 0,' . $limit)->loadObjectList();
        }
        return $location[$userid];
    }
    
    public static function getEmployee($userid = null, $limit = 2){
        if(!$userid) $userid = JFactory::getUser ()->id;
        if(!$userid) return false;
        static $employee;
        if(!isset($employee[$userid])){
            $db = JFactory::getDbo();
            $employee[$userid] = $db->setQuery('SELECT a.*,c.company FROM #__dtax_employees as a '
                    . 'LEFT JOIN #__dtax_company as c ON c.id=a.company_id ' . self::where('a') . ' LIMIT 0,' . $limit)->loadObjectList();
        }
        return $employee[$userid];
    }
    
    public static function getAppoint($userid = null, $limit = 5, $today = false){
        if(!$userid) $userid = JFactory::getUser ()->id;
        if(!$userid) return false;
        static $employee;
        $params = md5($userid . $limit . $today);
        if(!isset($employee[$params])){
            $db = JFactory::getDbo();
            $w = '';
            if($today) $w = ' AND a.appdate=' . $db->quote(date('Y-m-d'));
            $employee[$params] = $db->setQuery('SELECT a.* FROM #__dtax_appointments as a '
                     . self::where('a') . $w . ' ORDER BY a.id desc LIMIT 0,' . $limit . ' ')->loadObjectList();
        }
        return $employee[$params];
    }
    
    public static function getTaxReturn($userid = null, $limit = 5){
        if(!$userid) $userid = JFactory::getUser ()->id;
        if(!$userid) return false;
        static $taxreturn;
        $params = md5($userid . $limit);
        if(!isset($taxreturn[$params])){
            $db = JFactory::getDbo();
            $w = '';
            $taxreturn[$params] = $db->setQuery('SELECT a.* FROM #__dtax_taxreturns as a '
                     . self::where('a') . $w . ' ORDER BY a.id desc LIMIT 0,' . $limit . ' ')->loadObjectList();
        }
        return $taxreturn[$params];
    }
    
    public static function getJsonAppoint(){
        $appoints = self::getAppoint(0, 500);
        $input = JFactory::getApplication()->input;
        $Itemid = $input->getInt('Itemid', 0);
        $data = array();
        foreach ($appoints as $i=>$app){
            $item = array();
            if($app->apptime){
                $time = explode (' ',$app->apptime);
                $min = explode (':',$time[0]);
                if($time[1] == 'PM'){
                    $totalTime = (int)$min[0]+12 . ':'. $min[1];
                }else{
                    $totalTime = implode(':', $min);
                }
            }else $totalTime = '00:00:00';
            $item['title'] = $app->taxpayer . ' - ' . $app->phone. ' - ' . $app->service;
            $item['start'] = $app->appdate . 'T' . $totalTime . ':00';
            $item['url'] = JRoute::_('index.php?option=com_dtax&task=appointment.edit&id='.$app->id.'&Itemid='.$Itemid);
            $data[$i] = (object) $item;
        }
        return $data;
    }
    
    
    public static function getEmail($userid = null, $limit = 5){
        if(!$userid) $userid = JFactory::getUser ()->id;
        if(!$userid) return false;
        static $email;
        if(!isset($email[$userid])){
            $db = JFactory::getDbo();
            $email[$userid] = $db->setQuery('SELECT * FROM #__dtax_email' . self::where() . ' LIMIT 0,' . $limit)->loadObjectList();
        }
        return $email[$userid];
    }
    
    public static function getLink($view = 'homepage'){
        $input = JFactory::getApplication()->input;
        $Itemid = $input->getInt('Itemid', 0);
        $links = array(
            'homepage' => JRoute::_('index.php?option=com_dtax&view=homepage&Itemid='.$Itemid),
            'locations' => JRoute::_('index.php?option=com_dtax&view=locations&Itemid='.$Itemid),
            'employees' => JRoute::_('index.php?option=com_dtax&view=employees&Itemid='.$Itemid),
            'taxreturns' => JRoute::_('index.php?option=com_dtax&view=taxreturns&Itemid='.$Itemid),
            'emails' => JRoute::_('index.php?option=com_dtax&view=emails&Itemid='.$Itemid),
            'companies' => JRoute::_('index.php?option=com_dtax&view=companies&Itemid='.$Itemid),
            'appointments' => JRoute::_('index.php?option=com_dtax&view=appointments&Itemid='.$Itemid),
        );
        return $links[$view];
    }
        
}