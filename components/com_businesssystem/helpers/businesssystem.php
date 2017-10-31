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
    
    public static function getAlerts($acc_id = 0){
        if(!$acc_id) $acc_id = self::getProfile ()->id;
        if(!$acc_id) return false;
        static $alerts;
        if(!isset($alerts)){
            $db = JFactory::getDbo();
            $alerts = $db->setQuery('SELECT * FROM #__businesssystem_orders WHERE account_id = ' . $acc_id)->loadObjectList();
        }
        return $alerts;
    }
    
    public static function getCompanies($acc_id = 0){
        if(!$acc_id) $acc_id = self::getProfile ()->id;
        if(!$acc_id) return false;
        static $companies;
        if(!isset($alerts)){
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);

            // Select the required fields from the table.
            $query->select('a.*');
            $query->from('`#__businesssystem_company` AS a');
            $query->select('CONCAT(ac.firstname," ",ac.midname," ",ac.lastname) as name');
            $query->join('LEFT', '`#__businesssystem_accounts` AS ac ON ac.id = a.account_id');
            $query->select('c.title');
            $query->join('LEFT', '`#__businesssystem_categories` AS c ON c.id = a.order_status');
            $query->where('a.account_id = ' . $acc_id);
            $companies = $db->setQuery($query)->loadObjectList();
        }
        return $companies;
    }
    
    
    
    public static function getProfile($userid = 0){
        if(!$userid) $userid = JFactory::getUser ()->id;
        if(!$userid) return false;
        static $account;
        if(!isset($account)){
            $db = JFactory::getDbo();
            $account = $db->setQuery('SELECT * FROM #__businesssystem_accounts WHERE userid = ' . $userid)->loadObject();
            $account->user = JFactory::getUser($userid);
        }
        return $account;
    }
    
    
    public static function navHeader(){
        $profile = self::getProfile();
        $input = JFactory::getApplication()->input;
        if(!$profile) return;
        $config = self::getConfig();
        ?>
        <div class="BusinessProfile">
            <p><?php echo $profile->user->name; ?> <span><?php echo self::logout(); ?></span></p>
        </div>
        <div class="BusinessMenuItem">
            
            <div class="menulink">
                <?php if($config->menu1 || $config->menu2){ ?>
                <ul>
                    <?php if($config->menu1){  $menu1 = JRoute::_('index.php?Itemid=' . $config->menu1)?>
                    <li><a href="<?php echo $menu1; ?>" ><?php echo $config->text1; ?></a></li>
                    <?php } ?>
                    <?php if($config->menu2){  $menu2 = JRoute::_('index.php?Itemid=' . $config->menu2)?>
                    <li><a href="<?php echo $menu2; ?>" ><?php echo $config->text2; ?></a></li>
                    <?php } ?>
                </ul>
                <?php } ?>
            </div>
            
            <div class="brackbrun">
                <h4 class="headerPage">
                <?php if($input->getString('view') == 'homepage') echo 'Overview'; ?>
                </h4>
            </div>
        </div>
        <?php
    }
    
    public static function navSubMenu($v = ''){
        $input = JFactory::getApplication()->input;
        $Itemid = $input->getInt('Itemid', 0);
        if(!$v) $v = $input->getString('view');
        ob_start();
        ?>
        <ul class="menuHeader">
            <li class="<?php if($v == 'homepage') echo 'active'; ?>"><a  href="<?php echo JRoute::_('index.php?option=com_businesssystem&view=homepage&Itemid='.$Itemid); ?>" >Overview</a></li>
            <li class="<?php if($v == 'orders') echo 'active'; ?>"><a  href="<?php echo JRoute::_('index.php?option=com_businesssystem&view=orders&Itemid='.$Itemid); ?>" >Orders Status</a></li>
            <li class="<?php if($v == 'documents') echo 'active'; ?>"><a  href="<?php echo JRoute::_('index.php?option=com_businesssystem&view=documents&Itemid='.$Itemid); ?>"  >Files & Documents</a></li>
            <li class="<?php if($v == 'profile') echo 'active'; ?>"><a  href="<?php echo JRoute::_('index.php?option=com_businesssystem&view=profile&Itemid='.$Itemid); ?>" >Profile</a></li>
        </ul>
        <?php
        return ob_get_clean();
    }
    
    public static function header(){
        if(self::isCom()){
            echo '<div id="BusinessSystemMain" class="BusinessSystemMain">';
                echo '<div class="jkMain">';
                    echo '<div id="BusinessSystemHeader" class="">';
                        echo self::navHeader();
                    echo '</div>';
                echo '</div>';
                echo '<div id="mainContentBusiness" class="">';
                    echo '<div class="navSubMenu">';
                        echo self::navSubMenu();
                    echo '</div>';
        }
    }
    
    public static function footer(){
        if(self::isCom()){
            echo '</div></div>';
        }
    }
    
   
   
}