<?php

/**
 * @version    CVS: 1.0.0
 * @package    Com_BusinessSystem
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

require_once JPATH_ADMINISTRATOR.'/components/com_businesssystem/helpers/businesssystem.php';
class JST extends jSont{
    
    
    public static function getAllChildOfMainCpa($mainCpa){ 
        $db = JFactory::getDbo();
        $locations = $db->setQuery('SELECT * FROM #__businesssystem_locations WHERE cpaid=' . $mainCpa->id)->loadObjectList();
        $lists = array(
            'maincpa' => array($mainCpa->id),
            'userid' => array($mainCpa->userid),
        );
        foreach ($locations as $l){
            $lists['cpa'][] = $l->id;
            $lists['userid'][] = $l->userid;
            $customers = $db->setQuery('SELECT * FROM #__businesssystem_customers WHERE cpaid=' . $l->id)->loadObjectList();
            foreach ($customers as $c){
                $lists['customer'][] = $c->id;
                $lists['userid'][] = $c->userid;
                $compnay = $db->setQuery('SELECT * FROM #__businesssystem_company WHERE customer_id=' . $c->id)->loadObjectList();
                foreach ($compnay as $co){
                    $lists['compnay'][] = $co->id;
                    $lists['userid'][] = $co->userid;
                }
            }
        }
        return $lists;
    }
    
    
    public static function getAllChildOfCpa($cpa){ 
        $db = JFactory::getDbo();
        $lists = array(
            'cpa' => array($cpa->id),
            'userid' => array($cpa->userid),
        );
        $customers = $db->setQuery('SELECT * FROM #__businesssystem_customers WHERE cpaid=' . $cpa->id)->loadObjectList();
        foreach ($customers as $c){
            $lists['customer'][] = $c->id;
            $lists['userid'][] = $c->userid;
            $compnay = $db->setQuery('SELECT * FROM #__businesssystem_company WHERE customer_id=' . $c->id)->loadObjectList();
            foreach ($compnay as $co){
                $lists['compnay'][] = $co->id;
                $lists['userid'][] = $co->userid;
            }
        }
        return $lists;
    }
    
    public static function getAllChildOfCustomer($customer){ 
        $db = JFactory::getDbo();
        $lists = array(
            'customer' => array($customer->id),
            'userid' => array($customer->userid),
        );
        $compnay = $db->setQuery('SELECT * FROM #__businesssystem_company WHERE customer_id=' . $customer->id)->loadObjectList();
        foreach ($compnay as $co){
            $lists['compnay'][] = $co->id;
            $lists['userid'][] = $co->userid;
        }
        return $lists;
    }
    
    
    public static function getCreatedBy($userid){ 
        if(!$userid) $userid = JFactory::getUser ()->id;
        if(!$userid) return false;
        static $lists;
        if($mainCpa = self::isMainBDS($userid)){
            $lists[$userid] = self::getAllChildOfMainCpa($mainCpa);
        }else if($childBDS = self::isChildBDS($userid)){
            $lists[$userid] = self::getAllChildOfCpa($childBDS);
        }else if($customer = self::isCustomer($userid)){
            $lists[$userid] = self::getAllChildOfCustomer($customer);
        }else if($company = self::isCompany($userid)){
            $lists[$userid] = array(
                'userid' => array($company->userid),
            );
        }else{
            $lists[$userid] = array(
                'userid' => array($userid),
            );
        }
        return $lists[$userid];
    }
    
    
    public static function dbFilter($table = '', $t = ''){ 
        $userid = JFactory::getUser ()->id;
        $lists = (object) self::getCreatedBy($userid);
        $createdBy = (array) $userid;
        $where = '';
        if($table == 'cpas'){
            //if(self::isMainBDS()) $where .= " AND $t.id IN (" .implode(',', $lists->maincpa) . ") ";
        }
        if($table == 'locations'){
            if(self::isMainBDS()) $where .= " AND $t.cpaid IN (" .implode(',', $lists->maincpa) . ") ";
        }
        if($table == 'customers'){
            if(self::isMainBDS()) $where .= " AND ( $t.maincpa IN (" .implode(',', $lists->maincpa) . ") OR $t.cpaid IN (" .implode(',', $lists->cpa) . ") ) ";
            if(self::isChildBDS()) $where .= " AND $t.cpaid IN (" .implode(',', $lists->cpa) . ") ";
        }
        if($table == 'compnay'){
            if(self::isMainBDS()) $where .= " AND ( $t.maincpa IN (" .implode(',', $lists->maincpa) . ") OR $t.cpaid IN (" .implode(',', $lists->cpa) . ") OR  $t.customer_id IN (" .implode(',', $lists->customer) . ") ) ";
            if(self::isChildBDS()) $where .= " AND ($t.cpaid IN (" .implode(',', $lists->cpa) . ") OR $t.customer_id IN (" .implode(',', $lists->customer) . ") )";
            if(self::isCustomer()) $where .= " AND $t.customer_id IN (" .implode(',', $lists->customer) . ") ";
        }

        if($table == 'expenses' || $table == 'invoices' || $table == 'mileages' || $table == 'receipts' || $table == 'taxreturns'){
            if(self::isMainBDS()) $where .= " AND $t.created_by IN (" .implode(',', $lists->userid) . ") ";
            else if(self::isChildBDS()) $where .= " AND $t.created_by IN (" .implode(',', $lists->userid) . ") ";
            else if(self::isCustomer()) $where .= " AND $t.created_by IN (" .implode(',', $lists->userid) . ") ";
            else if(self::isCompany()) $where .= " AND $t.created_by IN (" .implode(',', $lists->userid) . ") ";
            else{
                $where .= " AND $t.created_by IN (" .implode(',', $lists->userid) . ") ";
            }
        }
        
        return $where;
        
    }
    
    public static function dbwhere(&$query, $table='', $t=''){
        
    }
    public static function getExpenses(){
        static $data;
        if(!$data){
            $db = JFactory::getDbo();
            $total = $db->setQuery('SELECT SUM(t.total) FROM #__businesssystem_expenses as t WHERE t.id > 0 ' .self::dbFilter('expenses', 't'))->loadResult();
            $cYear = date('Y');
            $lists = $db->setQuery("SELECT t.* FROM #__businesssystem_expenses as t WHERE YEAR(t.created) = '$cYear' " .self::dbFilter('expense', 't'))->loadObjectList();
            $lists = self::parseChart($lists);
            $data = (object) array('total' => $total, 'lists' => $lists);
        }
        return $data;
    } 
    
    public static function getReceipts(){
        static $data;
        if(!$data){
            $db = JFactory::getDbo();
            $total = $db->setQuery('SELECT SUM(t.total) FROM #__businesssystem_receipts as t WHERE id > 0 ' . self::dbFilter('receipts', 't'))->loadResult();
            $cYear = date('Y');
            $lists = $db->setQuery("SELECT * FROM #__businesssystem_receipts as t WHERE YEAR(t.created) = '$cYear' " .self::dbFilter('receipts', 't') )->loadObjectList();
            $lists = self::parseChart($lists);
            $data = (object)  array('total' => $total, 'lists' => $lists);
        }
        return $data;
    } 
    
    public static function getMileages(){
        static $data;
        if(!$data){
            $db = JFactory::getDbo();
            $total = $db->setQuery('SELECT COUNT(*) FROM #__businesssystem_mileages as t WHERE t.id > 0 ' . self::dbFilter('mileages', 't'))->loadResult();
            $cYear = date('Y');
            $lists = $db->setQuery("SELECT * FROM #__businesssystem_mileages as t WHERE YEAR(t.created) = '$cYear' " . self::dbFilter('mileages', 't'))->loadObjectList();
            $lists = self::parseChart($lists);
            $data = (object) array('total' => $total, 'lists' => $lists);
        }
        return $data;
    } 
    
    
    public static function getInvoices(){
        static $data;
        if(!$data){
            $db = JFactory::getDbo();
            $total = $db->setQuery('SELECT COUNT(*) FROM #__businesssystem_invoices as t WHERE t.id > 0 ' . self::dbFilter('mileages', 't'))->loadResult();
            $cYear = date('Y');
            $lists = $db->setQuery("SELECT * FROM #__businesssystem_invoices as t WHERE YEAR(t.created) = '$cYear' " . self::dbFilter('mileages', 't'))->loadObjectList();
            $lists = self::parseChart($lists);
            $data = (object) array('total' => $total, 'lists' => $lists);
        }
        return $data;
    } 
    
    public static function getTaxs(){
        static $data;
        if(!$data){
            $db = JFactory::getDbo();
            $total = $db->setQuery('SELECT COUNT(*) FROM #__businesssystem_taxreturns t WHERE t.id > 0 ' . self::dbFilter('taxreturns', 't'))->loadResult();
            $cYear = date('Y');
            $lists = $db->setQuery("SELECT * FROM #__businesssystem_taxreturns t WHERE YEAR(created) = '$cYear' " . self::dbFilter('taxreturns', 't') )->loadObjectList();
            $lists = self::parseChart($lists);
            $data = (object)  array('total' => $total, 'lists' => $lists);
        }
        return $data;
    } 
    
    public static function getCustomer(){
        static $data;
        if(!$data){
            $db = JFactory::getDbo();
            $total = $db->setQuery('SELECT COUNT(*) FROM #__businesssystem_customers t WHERE t.id > 0 ' . self::dbFilter('customers', 't'))->loadResult();
            $cYear = date('Y');
            $lists = $db->setQuery("SELECT * FROM #__businesssystem_customers t WHERE YEAR(t.created) = '$cYear' " .self::dbFilter('customers', 't'))->loadObjectList();
            $lists = self::parseChart($lists);
            $data = (object) array('total' => $total, 'lists' => $lists);
        }
        return $data;
    } 
    
    
    public static function parseChart($list){
        $month = array(
            'Jan' => 0,
            'Feb' => 0,
            'Mar' => 0,
            'Apr' => 0,
            'May' => 0,
            'Jul' => 0,
            'Jun' => 0,
            'Aug' => 0,
            'Sep' => 0,
            'Oct' => 0,
            'Nov' => 0,
            'Dec' => 0,
        );
        foreach ($list as $l){
            if(JFactory::getDate($l->created)->format('m') == '01') $month['Jan'] = $month['Jan'] + 1;
            if(JFactory::getDate($l->created)->format('m') == '02') $month['Feb'] = $month['Feb'] + 1;
            if(JFactory::getDate($l->created)->format('m') == '03') $month['Mar'] = $month['Mar'] + 1;
            if(JFactory::getDate($l->created)->format('m') == '04') $month['Apr'] = $month['Apr'] + 1;
            if(JFactory::getDate($l->created)->format('m') == '05') $month['May'] = $month['May'] + 1;
            if(JFactory::getDate($l->created)->format('m') == '06') $month['Jul'] = $month['Jul'] + 1;
            if(JFactory::getDate($l->created)->format('m') == '07') $month['Jun'] = $month['Jun'] + 1;
            if(JFactory::getDate($l->created)->format('m') == '08') $month['Aug'] = $month['Aug'] + 1;
            if(JFactory::getDate($l->created)->format('m') == '09') $month['Sep'] = $month['Sep'] + 1;
            if(JFactory::getDate($l->created)->format('m') == '10') $month['Oct'] = $month['Oct'] + 1;
            if(JFactory::getDate($l->created)->format('m') == '11') $month['Nov'] = $month['Nov'] + 1;
            if(JFactory::getDate($l->created)->format('m') == '12') $month['Dec'] = $month['Dec'] + 1;
        }
        //foreach ($month as &$m) $m = $m/1000;
        return (object)$month;
    }
    
    public static function getChart($userid = 0){
        if(!$userid) $userid = JFactory::getUser ()->id;
        if(!$userid) return false;
        $cpa = self::isBDS($userid);
        $document = JFactory::getDocument();
        $document->addScript(JURI::root() . 'components/com_businesssystem/assets/js/canvasjs.min.js');
        if($cpa){
            $chart1 = self::getInvoices()->lists;
            $chart1->name = 'Invoices';
            $chart2 = self::getTaxs()->lists;
            $chart2->name = 'Tax Returns';
            $chart3 = self::getCustomer()->lists;
            $chart3->name = 'Customers';
        }else if(self::isCTM()){
            $chart1 = self::getExpenses()->lists;
            $chart1->name = 'Expenses';
            $chart2 = self::getReceipts()->lists;
            $chart2->name = 'Receipts';
            $chart3 = self::getMileages()->lists;
            $chart3->name = 'Mileages';
        }else return;
            
            ?>
            <script type="text/javascript">
                window.onload = function () {
                  var chart = new CanvasJS.Chart("chartContainer",
                  {
                    theme: "theme2",
                    animationEnabled: true,
                    axisX: {
                      valueFormatString: "MMM",
                      interval:1,
                      intervalType: "month"

                    },
                    axisY:{
                      includeZero: false,
                      background : '#000'
                    },
                    data: [
                    {        
                      type: "line",
                      name: "<?php echo $chart1->name; ?>",
                      showInLegend: true,
                      color: "#fbac2b",
                      //lineThickness: 3,        
                      dataPoints: [
                      { x: new Date(2012, 00, 1), y: '<?php echo $chart1->Jan; ?>' },
                      { x: new Date(2012, 01, 1), y: '<?php echo $chart1->Feb; ?>'},
                      { x: new Date(2012, 02, 1), y: '<?php echo $chart1->Mar; ?>'},
                      { x: new Date(2012, 03, 1), y: '<?php echo $chart1->Apr; ?>' },
                      { x: new Date(2012, 04, 1), y: '<?php echo $chart1->May; ?>' },
                      { x: new Date(2012, 05, 1), y: '<?php echo $chart1->Jul; ?>' },
                      { x: new Date(2012, 06, 1), y: '<?php echo $chart1->Jun; ?>' },
                      { x: new Date(2012, 07, 1), y: '<?php echo $chart1->Aug; ?>' },
                      { x: new Date(2012, 08, 1), y: '<?php echo $chart1->Sep; ?>' },
                      { x: new Date(2012, 09, 1), y: '<?php echo $chart1->Oct; ?>' },
                      { x: new Date(2012, 10, 1), y: '<?php echo $chart1->Nov; ?>' },
                      { x: new Date(2012, 11, 1), y: '<?php echo $chart1->Dec; ?>' }

                      ]
                    },
                    {        
                      type: "line",
                      name: "<?php echo $chart2->name; ?>",
                      showInLegend: true,
                      color: "#91908f",
                      //lineThickness: 3,        
                      dataPoints: [
                      { x: new Date(2012, 00, 1), y: '<?php echo $chart2->Jan; ?>' },
                      { x: new Date(2012, 01, 1), y: '<?php echo $chart2->Feb; ?>'},
                      { x: new Date(2012, 02, 1), y: '<?php echo $chart2->Mar; ?>'},
                      { x: new Date(2012, 03, 1), y: '<?php echo $chart2->Apr; ?>' },
                      { x: new Date(2012, 04, 1), y: '<?php echo $chart2->May; ?>' },
                      { x: new Date(2012, 05, 1), y: '<?php echo $chart2->Jul; ?>' },
                      { x: new Date(2012, 06, 1), y: '<?php echo $chart2->Jun; ?>' },
                      { x: new Date(2012, 07, 1), y: '<?php echo $chart2->Aug; ?>' },
                      { x: new Date(2012, 08, 1), y: '<?php echo $chart2->Sep; ?>' },
                      { x: new Date(2012, 09, 1), y: '<?php echo $chart2->Oct; ?>' },
                      { x: new Date(2012, 10, 1), y: '<?php echo $chart2->Nov; ?>' },
                      { x: new Date(2012, 11, 1), y: '<?php echo $chart2->Dec; ?>' }

                      ]
                    },
                    {        
                      type: "line",
                      name: "<?php echo $chart3->name; ?>",
                      showInLegend: true,
                    color: "#333",
                      //lineThickness: 3,        
                      dataPoints: [
                      { x: new Date(2012, 00, 1), y: '<?php echo $chart3->Jan; ?>' },
                      { x: new Date(2012, 01, 1), y: '<?php echo $chart3->Feb; ?>'},
                      { x: new Date(2012, 02, 1), y: '<?php echo $chart3->Mar; ?>'},
                      { x: new Date(2012, 03, 1), y: '<?php echo $chart3->Apr; ?>' },
                      { x: new Date(2012, 04, 1), y: '<?php echo $chart3->May; ?>' },
                      { x: new Date(2012, 05, 1), y: '<?php echo $chart3->Jul; ?>' },
                      { x: new Date(2012, 06, 1), y: '<?php echo $chart3->Jun; ?>' },
                      { x: new Date(2012, 07, 1), y: '<?php echo $chart3->Aug; ?>' },
                      { x: new Date(2012, 08, 1), y: '<?php echo $chart3->Sep; ?>' },
                      { x: new Date(2012, 09, 1), y: '<?php echo $chart3->Oct; ?>' },
                      { x: new Date(2012, 10, 1), y: '<?php echo $chart3->Nov; ?>' },
                      { x: new Date(2012, 11, 1), y: '<?php echo $chart3->Dec; ?>' }

                      ]
                    }


                    ]
                  });

              chart.render();
              }
              </script>
            <div id="chartContainer" style="height: 100%; width: 100%;"></div>
            <?php
        
    }
    
    
   
    public static function profile($userid = 0){
        if(!$userid) $userid = JFactory::getUser ()->id;
        if(!$userid) return false;
        $cpa = self::isBDS($userid);
        if($cpa){
            ?>
            <div class="span12">
                <div class="profile-logo span3">
                    <img src="<?php echo $cpa->logo; ?>" />
                </div>
                <div class="profile-info span3">
                    <h3><?php echo $cpa->company ;?></h3>
                    <p><?php echo $cpa->cpa ;?></p>
                </div>
                <div class="profile-contact span3">
                    <p><span class="key">Email</span> <span class="value"><?php echo $cpa->email; ?></span></p>
                    <p><span class="key">Phone</span> <span class="value"><?php echo $cpa->phone; ?></span></p>
                    <p><span class="key">Website</span> <span class="value"><?php echo $cpa->url; ?></span></p>
                </div>
                <div class="clearfix"></div>
            </div>
            <?php
        }else if($customer = self::isCTM($userid)){
            ?>
            <div class="span12">
                <div class="profile-logo span3">
                    <img src="<?php echo $customer->logo; ?>" />
                </div>
                <div class="profile-info span3">
                    <h3><?php echo $customer->company ;?></h3>
                    <p><?php echo $customer->company ;?></p>
                </div>
                <div class="profile-contact span3">
                    <p><span class="key">Email</span> <span class="value"><?php echo $customer->email; ?></span></p>
                    <p><span class="key">Phone</span> <span class="value"><?php echo $customer->phone; ?></span></p>
                    <p><span class="key">Website</span> <span class="value"><?php echo $customer->url; ?></span></p>
                </div>
                <div class="clearfix"></div>
            </div>
            <?php
        }
    }
    
    public static function toolbar($task = '',$bnt = ''){
        if(!$task) return;
            ?>
            <div id="btn-toolbar" class="btn-toolbar">
                <?php if($bnt){ ?>
                    <?php if($task == 'cpa'){ ?>
                        <button onclick="Joomla.submitbutton('<?php echo $task; ?>.add')" class="btn btn-small btn-success">
                            <span class="icon-new icon-white"></span> New
                        </button>
                        <button onclick="if (document.adminForm.boxchecked.value==0){alert('Please first make a selection from the list.');}else{ Joomla.submitbutton('<?php echo $task; ?>s.delete')}" class="btn btn-small">
                            <span class="icon-delete"></span> Delete
                        </button>
                    <?php }else if($task == 'location'){ ?>
                        <?php if(self::isMainBDS()){ ?>
                            <button onclick="Joomla.submitbutton('<?php echo $task; ?>.add')" class="btn btn-small btn-success">
                                <span class="icon-new icon-white"></span> New
                            </button>
                            <button onclick="if (document.adminForm.boxchecked.value==0){alert('Please first make a selection from the list.');}else{ Joomla.submitbutton('<?php echo $task; ?>s.delete')}" class="btn btn-small">
                                <span class="icon-delete"></span> Delete
                            </button>
                        <?php }else{ ?>
                
                        <?php } ?>
                    <?php }else{ ?>
                        <button onclick="Joomla.submitbutton('<?php echo $task; ?>.add')" class="btn btn-small btn-success">
                            <span class="icon-new icon-white"></span> New
                        </button>
                        <button onclick="if (document.adminForm.boxchecked.value==0){alert('Please first make a selection from the list.');}else{ Joomla.submitbutton('<?php echo $task; ?>s.delete')}" class="btn btn-small">
                            <span class="icon-delete"></span> Delete
                        </button>
                    <?php } ?>
                <?php } else{ ?>
                
                    <?php if($task == 'cpa'){ ?>
                        <div class="btn-group">
                                <button type="button" class="btn btn-primary" onclick="Joomla.submitbutton('<?php echo $task;?>.apply')">
                                        <span class="icon-ok"></span><?php echo JText::_('JSAVE') ?>
                                </button>
                        </div>
                    <?php }else if($task =='location'){ ?>
                        <?php if(self::isChildBDS()){ ?>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary" onclick="Joomla.submitbutton('<?php echo $task;?>.apply')">
                                        <span class="icon-ok"></span><?php echo JText::_('JSAVE') ?>
                                </button>
                            </div>
                        <?php }else{ ?>
                            <div class="btn-group">
                                    <button type="button" class="btn btn-primary" onclick="Joomla.submitbutton('<?php echo $task;?>.save')">
                                            <span class="icon-ok"></span><?php echo JText::_('JSAVE') ?>
                                    </button>
                            </div>
                            <button onclick="Joomla.submitbutton('location.add')" class="btn btn-small btn-success">
                                <span class="icon-new icon-white"></span> New
                            </button>
                        <?php } ?>
                    <?php } else { ?>
                        <?php if(($task =='customer' && self::isCustomer()) || ($task =='company' && self::isCompany())){ ?>
                            <div class="btn-group">
                                    <button type="button" class="btn btn-primary" onclick="Joomla.submitbutton('<?php echo $task;?>.apply')">
                                            <span class="icon-ok"></span><?php echo JText::_('JSAVE') ?>
                                    </button>
                            </div>
                        <?php }else{ ?>
                            <div class="btn-group">
                                    <button type="button" class="btn btn-primary" onclick="Joomla.submitbutton('<?php echo $task;?>.save')">
                                            <span class="icon-ok"></span><?php echo JText::_('JSAVE') ?>
                                    </button>
                            </div>
                            <?php if($task !=='cpa'){ ?>
                            <div class="btn-group">
                                    <button type="button" class="btn" onclick="Joomla.submitbutton('<?php echo $task;?>.cancel')">
                                            <span class="icon-cancel"></span><?php echo JText::_('JCANCEL') ?>
                                    </button>
                            </div>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            </div>
            <?php
        }
        
    public static function checkBDS($userid = 0){
        if(!$userid) $userid = JFactory::getUser ()->id;
        if(!$userid) return false;
        $cpa = self::isBDS($userid);
        if(!$cpa->id) die('You are not permission');
    }
        
    public static function cpaLeft(){
        echo self::Menu();
        echo self::logo();
        echo self::userInfo();
        echo self::logout();
    }    
    public static function isCom(){
        return true;
    }
    
     public static function logout(){
        ?>
        <form id="jkLogout" action="<?php echo JRoute::_('index.php?option=com_users&task=user.logout'); ?>" method="post">
                <input type="hidden" name="return" value="<?php echo base64_encode('index.php?option=com_users&view=login'); ?>" />
                <input type="hidden" name="option" value="com_users" />
                <input type="hidden" name="task" value="user.logout" />
                <?php echo JHtml::_('form.token'); ?>
        </form>
        <a class="jk-logout" href="javascript:void(0)">[Log Out]</a>
        <script>
                jQuery(function($){
                        $('a.jk-logout').click(function(){
                            $('#jkLogout').submit();
                        });
						return false;
                })
        </script>
        <?php
    }
    
    public static function Menu($view = ''){
        
        $input = JFactory::getApplication()->input;
        $Itemid = $input->getInt('Itemid', 0);
        if(!$view) $view = $input->getString('view', 'frontend');
        $customers = array('customers','customer','invoices','invoice','expenses','expense','receipts','receipt','mileages','mileage','companies','company');
        ob_start();
        ?>
        <div id="menu">
            <ul>
                <li class="homepage <?php if($view=='homepage') echo 'active';?>"><a href="<?php echo JRoute::_('index.php?option=com_businesssystem&view=homepage&Itemid='.$Itemid); ?>"><?php echo JText::_('Home'); ?></a></li>
                <?php if(jSont::isBDS()){ ?>
                    <?php if(jSont::isMainBDS()){ ?>
                        <li class="profiles <?php if($view=='cpa' || $view=='location' || $view=='locations') echo 'active';?>"><a href="<?php echo JRoute::_('index.php?option=com_businesssystem&view=cpa&Itemid='.$Itemid); ?>"><?php echo JText::_('Profile'); ?></a></li>
                    <?php }else if($c = self::isChildBDS()){ ?>
                        <li class="profiles <?php if($view=='location') echo 'active';?>"><a href="<?php echo JRoute::_('index.php?option=com_businesssystem&view=location&layout=edit&id='.$c->id.'&Itemid='.$Itemid); ?>"><?php echo JText::_('Profile'); ?></a></li>
                    <?php } ?>
                    <li class="customers <?php if(in_array($view, $customers)) echo 'active';?>"><a href="<?php echo JRoute::_('index.php?option=com_businesssystem&view=customers&Itemid='.$Itemid); ?>"><?php echo JText::_('Customers'); ?></a></li>
                    <li class="taxreturns <?php if($view=='taxreturns' || $view=='taxreturn') echo 'active';?>"><a href="<?php echo JRoute::_('index.php?option=com_businesssystem&view=taxreturns&Itemid='.$Itemid); ?>"><?php echo JText::_('Tax Returns'); ?></a></li>
                <?php }else if(jSont::isCTM()){ ?>
                    <?php if($customer = jSont::isCustomer()){ ?>
                        <li class="customer <?php if($view=='customer') echo 'active';?>"><a href="<?php echo JRoute::_('index.php?option=com_businesssystem&view=customer&layout=edit&id='.$customer->id.'&Itemid='.$Itemid); ?>"><?php echo JText::_('Profile'); ?></a></li>
                        <li class="company <?php if($view=='companies' || $view=='company') echo 'active';?>"><a href="<?php echo JRoute::_('index.php?option=com_businesssystem&view=companies&Itemid='.$Itemid); ?>"><?php echo JText::_('Company'); ?></a></li>
                    <?php }else if($company = self::isCompany()){ ?>
                        <li class="customer <?php if($view=='company') echo 'active';?>"><a href="<?php echo JRoute::_('index.php?option=com_businesssystem&view=company&layout=edit&id='.$company->id.'&Itemid='.$Itemid); ?>"><?php echo JText::_('Profile'); ?></a></li>
                    <?php } ?>
                    <li class="expenses <?php if($view=='expenses' || $view=='expense') echo 'active';?>"><a href="<?php echo JRoute::_('index.php?option=com_businesssystem&view=expenses&Itemid='.$Itemid); ?>"><?php echo JText::_('Expenses'); ?></a></li>
                    <li class="receipts <?php if($view=='receipts' || $view=='receipt') echo 'active';?>"><a href="<?php echo JRoute::_('index.php?option=com_businesssystem&view=receipts&Itemid='.$Itemid); ?>"><?php echo JText::_('Rreceipts'); ?></a></li>
                    <li class="mileages <?php if($view=='mileages' || $view=='mileage') echo 'active';?>"><a href="<?php echo JRoute::_('index.php?option=com_businesssystem&view=mileages&Itemid='.$Itemid); ?>"><?php echo JText::_('Mileages'); ?></a></li>
                    <li class="taxreturns <?php if($view=='taxreturns' || $view=='taxreturn') echo 'active';?>"><a href="<?php echo JRoute::_('index.php?option=com_businesssystem&view=taxreturns&Itemid='.$Itemid); ?>"><?php echo JText::_('File Returns'); ?></a></li>
                <?php } ?>
            </ul>
        </div>
        <?php
        return ob_get_clean();
    }
    
    
     public static function logo(){
         $input = JFactory::getApplication()->input;
        $Itemid = $input->getInt('Itemid', 0);
        return '<a id="logo" alt="Dynamic Media" href="'. JRoute::_('index.php?option=com_businesssystem&view=homepage&Itemid='.$Itemid) .'">Dynamic Media</a>';
    }
    
    public static function userInfo($userid = 0){
        ob_start();
        echo '<div id="userInfo">';
        if($cpa = self::isBDS($userid)){
            ?>
            <div id="uinfo">
                <h4 class="key"><?php echo $cpa->company; ?></h4>
                <p class="key">Contact</p> <p class="value"><?php echo $cpa->cpa; ?></p>
                <p class="key">Address 1</p> <p class="value"><?php echo $cpa->address1; ?></p>
                <p class="key">Address 2</p> <p class="value"><?php echo $cpa->address2; ?></p>
            </div>

            <div id="ucontact">
                <table width="100%">
                    <tr>
                        <td class="key">City</td> <td class="key">State</td> <td class="key">Zip Code</td>
                    </tr>
                    <tr>
                        <td class="value"><?php echo $cpa->city; ?></td> <td class="value"><?php echo $cpa->state; ?></td> <td class="value"><?php echo $cpa->zip; ?></td>
                    </tr>
                </table>
                <?php
                $cpainfo = array(
                    'phone' => 'Phone',
                    'cell_phone' => 'Cell Phone',
                    'fax' => 'Fax',
                    'email' => 'Email',
                    'url' => 'Url',
                    );
                foreach ($cpainfo as $k=>$t){ ?>
                    <p class="key"><?php echo $t; ?></p> <p class="value"><?php echo $cpa->$k; ?></p>
                <?php } ?>
            </div>
                
            <?php
        }else if($customer = self::isCTM($userid)){
            ?>
            <div id="uinfo">
                <h4 class="key"><?php echo $customer->company; ?></h4>
                <p class="key">Contact</p> <p class="value"><?php echo $customer->customer; ?></p>
                <p class="key">Address 1</p> <p class="value"><?php echo $customer->address1; ?></p>
            </div>

            <div id="ucontact">
                <table width="100%">
                    <tr>
                        <td class="key">City</td> <td class="key">State</td> <td class="key">Zip Code</td>
                    </tr>
                    <tr>
                        <td class="value"><?php echo $customer->city; ?></td> <td class="value"><?php echo $customer->state; ?></td> <td class="value"><?php echo $customer->zip; ?></td>
                    </tr>
                </table>
                <?php
                $cinfo = array(
                    'phone' => 'Phone',
                    'cell_phone' => 'Cell Phone',
                    'fax' => 'Fax',
                    'email' => 'Email',
                    'url' => 'Url',
                    );
                foreach ($cinfo as $k=>$t){ ?>
                    <p class="key"><?php echo $t; ?></p> <p class="value"><?php echo $customer->$k; ?></p>
                <?php } ?>
            </div>
            <?php
        }
        echo '</div>';
        return ob_get_clean();
    }
    
    
    public static function header(){
        if(self::isCom()){
            echo '<div id="cpaMain" class="">';
            echo '<div class="jMain span12">';
            echo '<div id="cpaLeft" class="span3">';
            echo self::cpaLeft();
            echo '</div>';
            echo '<div id="mainContent" class="span9">';
        }
    }
    
    public static function footer(){
        if(self::isCom()){
            echo '</div></div></div>';
        }
    }
    
    public static function tabsMenu($v =''){
        if(self::isCTM()) return '';
        $input = JFactory::getApplication()->input;
        $Itemid = $input->getInt('Itemid', 0);
        if(!$v) $v = $input->getString('view');
        ?>
        <ul class="nav nav-tabs" id="myTabTabs">
            <li class="<?php if($v == 'customers' || $v =='customer') echo 'active'; ?>"><a  href="<?php echo JRoute::_('index.php?option=com_businesssystem&view=customers&Itemid='.$Itemid); ?>" >Customers</a></li>
            <li class="<?php if($v == 'companies' || $v =='company') echo 'active'; ?>"><a  href="<?php echo JRoute::_('index.php?option=com_businesssystem&view=companies&Itemid='.$Itemid); ?>" >Company</a></li>
            <li class="<?php if($v == 'invoices' || $v =='invoice') echo 'active'; ?>"><a  href="<?php echo JRoute::_('index.php?option=com_businesssystem&view=invoices&Itemid='.$Itemid); ?>"  >Invoices</a></li>
            <li class="<?php if($v == 'expenses' || $v =='expense') echo 'active'; ?>"><a  href="<?php echo JRoute::_('index.php?option=com_businesssystem&view=expenses&Itemid='.$Itemid); ?>" >Expenses</a></li>
            <li class="<?php if($v == 'receipts' || $v =='receipt') echo 'active'; ?>"><a  href="<?php echo JRoute::_('index.php?option=com_businesssystem&view=receipts&Itemid='.$Itemid); ?>" >Receipts</a></li>
            <li class="<?php if($v == 'mileages' || $v =='mileage') echo 'active'; ?>"><a  href="<?php echo JRoute::_('index.php?option=com_businesssystem&view=mileages&Itemid='.$Itemid); ?>"  >Mileages</a></li>
                        
        </ul>
        <?php
    }
    
    public static function tabBDS($v =''){
        if(self::isMainBDS()){
            $input = JFactory::getApplication()->input;
            $Itemid = $input->getInt('Itemid', 0);
            if(!$v) $v = $input->getString('view');
            ?>
            <ul class="nav nav-tabs" id="myTabTabs">
                <li class="<?php if($v == 'cpa') echo 'active'; ?>"><a  href="<?php echo JRoute::_('index.php?option=com_businesssystem&view=cpa&Itemid='.$Itemid); ?>" >Edit</a></li>
                <li class="<?php if($v == 'locations' || $v == 'location') echo 'active'; ?>"><a  href="<?php echo JRoute::_('index.php?option=com_businesssystem&view=locations&Itemid='.$Itemid); ?>"  >BDSs</a></li>
            </ul>
            <?php
        }
    }    
    
    
}