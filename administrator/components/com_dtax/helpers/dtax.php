<?php

/**
 * @version     1.0.0
 * @package     com_dtax
 * @copyright   Copyright (C) 2016 METIK Marketing, LLC. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Freddy Flores <fflores@metikmarketing.com> - https://www.metikmarketing.com
 */
// No direct access
defined('_JEXEC') or die;
 if(!function_exists('k')){
	 function k($str){
		 //if($_SERVER['REMOTE_ADDR'] == '14.161.35.175' || $_SERVER['REMOTE_ADDR'] == '::1' || $_SERVER['SERVER_NAME'] == 'localhost'){
			if($str){
				echo "<pre>";
				print_R($str);
				echo "</pre>";
			}else{
				echo "<pre>";
				var_dump($str);
				echo "</pre>";
			}
		//}
	 }
 }
class jSont extends DTaxHelper{
    
    
    
    public static $file_ext =  array(
        'archive' => array('7z', 'ace', 'bz2', 'dmg', 'gz', 'rar', 'tgz', 'zip'),
        'document' => array('csv', 'doc', 'docx', 'html', 'key', 'keynote', 'odp', 'ods', 'odt', 'pages', 'pdf', 'pps', 'ppt', 'pptx', 'rtf', 'tex', 'txt', 'xls', 'xlsx', 'xml'),
        'image' => array('bmp', 'exif', 'gif', 'ico', 'jpeg', 'jpg', 'png', 'psd', 'tif', 'tiff'),
        'audio' => array('aac', 'aif', 'aiff', 'alac', 'amr', 'au', 'cdda', 'flac', 'm3u', 'm3u', 'm4a', 'm4a', 'm4p', 'mid', 'mp3', 'mp4', 'mpa', 'ogg', 'pac', 'ra', 'wav', 'wma'),
        'video' => array('3gp', 'asf', 'avi', 'flv', 'm4v', 'mkv', 'mov', 'mp4', 'mpeg', 'mpg', 'ogg', 'rm', 'swf', 'vob', 'wmv')
    );
    
    public static function saveUser($data, $name =''){
        $user = new JUser();
        if(!$name) $name = $data['username'];
        $uData = array(
            'username' => $data['username'],
            'email' => $data['email'],
            'name'  => $name,
            'password'  => $data['password'],
            'password2'  => $data['password'],
            'groups' => array(2),
        );
        if($user->bind($uData)){
            if($user->save()){
                return $user;
            }
        }
        return false;
    }
    
    
    public static function isCustomer($userid = 0){
        if(!$userid) $userid = JFactory::getUser ()->id;
        if(!$userid) return false;
        static $customer;
        if(!isset($company[$userid])){
            $db = JFactory::getDbo();
            $customer[$userid] = $db->setQuery('SELECT *, CONCAT(firstname, " " ,midname, " " ,lastname) as customer FROM #__dtax_customers WHERE userid=' . $userid)->loadObject();
        }
        return $customer[$userid];
    }
    
    public static function isCompany($userid = 0){
        if(!$userid) $userid = JFactory::getUser ()->id;
        if(!$userid) return false;
        static $company;
        if(!isset($company[$userid])){
            $db = JFactory::getDbo();
            $company[$userid] = $db->setQuery('SELECT * FROM #__dtax_company WHERE userid=' . $userid)->loadObject();
            if($company[$userid]){
                if(!$company[$userid]->logo) $company[$userid]->logo = JUri::root () . 'components/com_dtax/assets/images/no_logo.png';
            }
        }
        return $company[$userid];
    }
    
   
    
	public static function getFileType($file){
        $pathinfo = pathinfo($file);
        $extension = strtolower(@$pathinfo['extension']);
        $imageTypes = array('bmp','exif','gif','ico','jpeg','jpg','png','psd','tif','tiff');
        $icon = JURI::root().'administrator/components/com_dtax/assets/images/file-icons/'.$extension.'.png';
        if(!is_file(JPATH_SITE.'/administrator/components/com_dtax/assets/images/file-icons/'.$extension.'.png'))
            $icon = JURI::root().'administrator/components/com_dtax/assets/images/file-icons/_blank.png';
        if(in_array($extension,$imageTypes)){
            return array('type'=>'image', 'extension'=>$extension, 'icon'=>$icon);
        }else{
            return array('type'=>$extension, 'extension'=>$extension, 'icon'=>$icon);
        }
    }
	
	public static function formatFileSize($bytes){
        if ($bytes >= 1073741824){
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }elseif ($bytes >= 1048576){
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }elseif ($bytes >= 1024){
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }elseif ($bytes > 1){
            $bytes = $bytes . ' bytes';
        }elseif ($bytes == 1){
            $bytes = $bytes . ' byte';
        }else{
            $bytes = '0 bytes';
        }
        return $bytes;
    }

	public static function checkFileUpload($file, $type){
        if($file['error']>0 && $file['error']<4){
            switch ($file['error'])
            {
                case 1:
                    return JText::_('File uplad large than php.ini').' '.ini_get( 'upload_max_filesize' );
                    break;
                case 2:
                    return JText::_('File uplad large than HTML');
                    break;
                case 3:
                    return JText::_('File uplad error');
                    break;
            }
        }
        if(!self::checkFileType($file['name'], $type)){
            return JText::_('Invalid Type');
        }
        return true;
    }
	
	public static function downloadFile($file){
        $file = str_replace(JUri::root(), JPATH_SITE.'/', $file);
        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.basename($file));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            ob_clean();
            flush();
            readfile($file);
            exit;
        }
    }

	
	public static function checkFileType($file, $type){
		return true;
        //$configs = self::getConfigs();
        $extension = pathinfo($file, PATHINFO_EXTENSION);
        if($type == 'file'){
            $fileTypes = explode(',', $configs->get('allowed_extensions'));
        }elseif($type == 'import'){
            $fileTypes = array('csv');
        }else{
            $fileTypes = self::$file_ext['image'];
        }
        if(!in_array($extension, $fileTypes)) return false;
        return true;
    }
	
	
	
	
	public static function sanitizeFileName($dangerous_filename){
        // our list of "dangerous characters", add/remove characters if necessary
        $dangerous_characters = array(" ", '"', "'", "&", "/", "\\", "?", "#");
        // every forbidden character is replace by an underscore
        return str_replace($dangerous_characters, '_', $dangerous_filename);
    }
	
	  public static function getMaximumUploadSize(){
        $max_upload = self::convertToBytes(ini_get('upload_max_filesize'));
        $max_post   = self::convertToBytes(ini_get('post_max_size'));
        return min($max_post, $max_upload);
    }

    public static function convertToBytes($value){
        $keys = array('k', 'm', 'g');
        $last_char = strtolower(substr($value, -1));
        $value = (int) $value;
        if (in_array($last_char, $keys)) {
            $value *= pow(1024, array_search($last_char, $keys)+1);
        }
        return $value;
    }
	
	public static function addMedia(){
    
        $document = JFactory::getDocument();
        
        JHtml::_('behavior.framework');
		JHtml::_('Jquery.framework');
		JHtml::_('bootstrap.framework');
        
        $document->addScript(JUri::root().'administrator/components/com_dtax/assets/libs/knockout.js');
        $document->addScript(JUri::root().'administrator/components/com_dtax/assets/libs/underscore-min.js');
        $document->addScript(JUri::root().'administrator/components/com_dtax/assets/libs/knockout.simpleGrid.js');
        $document->addScript(JUri::root().'administrator/components/com_dtax/assets/js/jquery.noconflict.js');
        $document->addStyleSheet(JUri::root().'administrator/components/com_dtax/assets/libs/font-awesome/css/font-awesome.css');
       
		$document->addStyleSheet(JUri::root().'administrator/components/com_dtax/assets/libs/plupload/js/jquery.plupload.queue/css/jquery.plupload.queue.css');
		$document->addScript(JUri::root().'administrator/components/com_dtax/assets/libs/plupload/js/plupload.full.min.js');
		$document->addScript(JUri::root().'administrator/components/com_dtax/assets/libs/plupload/js/jquery.plupload.queue/jquery.plupload.queue.js');
		$document->addScript(JUri::root().'administrator/components/com_dtax/assets/js/files.js');
		$document->addStyleSheet(JUri::root().'administrator/components/com_dtax/assets/css/files.css');
                   
    }
	
	
    
    
    public static  function loadAdminCss(){
        $document = JFactory::getDocument();
        //$document->addStyleSheet(JURI::root() . 'components/com_dtax/assets/css/dtax-frontend.css');
        $document->addStyleSheet(JURI::root() . 'administrator/components/com_dtax/assets/css/dtax.css');
        $document->addScript(JUri::root().'administrator/components/com_dtax/assets/js/jquery.noconflict.js');
        $document->addScript(JURI::root() . 'components/com_dtax/assets/js/dtax.js');
        //$document->addScript(JURI::root() . 'administrator/components/com_dtax/assets/js/js.js');
        self::upgradePermission();
		
    }
    
	
    public static  function loadFrontEndCss(){
        $document = JFactory::getDocument();
        $document->addStyleSheet(JURI::root() . 'components/com_dtax/assets/css/dtax-frontend.css');
        $document->addScript(JUri::root().'administrator/components/com_dtax/assets/js/jquery.noconflict.js');
        $document->addScript(JURI::root() . 'components/com_dtax/assets/js/dtax.js');
        //$document->addScript(JURI::root() . 'administrator/components/com_dtax/assets/js/js.js');
    }
    
    public static function upgradePermission(){
        $db = JFactory::getDbo();
        $db->setQuery('UPDATE #__assets SET rules=' . $db->quote('{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1,"2":1},"core.delete":{"2":1},"core.edit":{"4":1,"2":1},"core.edit.state":{"5":1,"2":1},"core.edit.own":{"2":1}}') . ' WHERE name=' . $db->quote('com_dtax'))->execute(); 
    }
    
    public static function getTable($table){
        JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_dtax/tables');
        return JTable::getInstance(ucwords($table),'DTaxTable');
    }
    
    public static function getModel($model){
        JModelLegacy::addIncludePath(JPATH_SITE . '/components/com_dtax/models', 'DTaxModel');
        return JModelLegacy::getInstance(ucwords($model), 'DTaxModel', array('ignore_request' => true));
    }
   
    public static function getLocation($id = 0){
        if(!$id) return false;
        $db = JFactory::getDbo();
        $location = $db->setQuery('SELECT * FROM #__dtax_locations WHERE id=' . (int) $id)->loadObject();
        return $location;
    }
    
    public static function getOptionCompany(){
        $db = JFactory::getDbo();
        $lists = $db->setQuery('SELECT company as name, id   FROM #__dtax_company ')->loadObjectList();
        $options[] = JHTML::_('select.option','', '- Select Company -');
        foreach ($lists as $l){
            $options[] = JHTML::_('select.option',$l->id, $l->name);
        }
	return $options;
    }
    
    public static function getOptionMileage(){
        $db = JFactory::getDbo();
        $lists = $db->setQuery('SELECT company as name, id   FROM #__dtax_mileages ')->loadObjectList();
        $options[] = JHTML::_('select.option','', '- Select Mileage -');
        foreach ($lists as $l){
            $options[] = JHTML::_('select.option',$l->id, $l->name);
        }
	return $options;
    }
    
    public static function getDirPath($type){
        if($type == 'files'){
            return 'images/cpamanage/files';
        }elseif($type == 'import'){
            return 'images/cpamanage/files/mobile';
        }else{
            return 'images/cpamanage/'.$type;
        }
    }
    
    
    public static function getIcon($fileName, $isCustom = 0){
        if($fileName && $isCustom){
            return JUri::root().self::getDirPath('icons').'/'.$fileName;
        }elseif($fileName){
            return JUri::root().'administrator/components/com_dtax/assets/images/file-icons/'.$fileName;
        }
        return JUri::root().'administrator/components/com_dtax/assets/images/file-icons/_blank.png';
    }

    
	public static function footer(){
		?>
			<form id="jkLogout" action="<?php echo JRoute::_('index.php?option=com_users&task=user.logout'); ?>" method="post">
				<input type="hidden" name="return" value="<?php echo base64_encode(JURI::root()); ?>" />
				<?php echo JHtml::_('form.token'); ?>
			</form>
			<a class="jk-logout" href="">[Logout]</a>
			<script>
                jQuery(function($){
                        $('a.jk-logout').click(function(){
                            $('#jkLogout').submit();
                        });
                })
            </script>
		<?php
	}
	
        
        
	public static function playAudio($audio){
		if(file_exists(JPATH_SITE . '/' . $audio)){
			?>
			<audio controls>
			  <source src="<?php echo JURI::root() . $audio ;?>" type="audio/mpeg">
			Your browser does not support the audio element.
			</audio>
			<p><a target="_blank" href="<?php echo JURI::root() . $audio ;?>">Link</a></p>
			<?php
			
		}else echo JText::_('File not found');
	}
	
    public static  function getComments($item_id = 0, $type = ''){
        if(!$item_id || !$type) return array();
        $db = JFactory::getDbo();
        $lists = $db->setQuery('select a.*,u.name from #__dtax_comments as a '
                . 'left join #__users as u ON u.id=a.userid '
                . 'where type="' . $type . '" AND item_id=' . (int) $item_id)->loadObjectList();
        return $lists;
    }
    
    public static  function format($date, $format = ''){
        if(!$format) return JHtml::_('date', $date, JText::_('DATE_FORMAT_LC3'), false);
        return JHtml::_('date', $date, $format, false); 
    }
    
	
    public static  function getCategory($type = 'category_expenses'){
        $category = jSont::getConfig()->$type;
        $lists = json_decode($category);
        return $lists;
                
    }
    
    public static  function getOptionCategory($type = 'category_expenses'){
        $lists = self::getCategory($type);
        $options[] = JHTML::_('select.option','', '- Select Category -');
        foreach ($lists as $l){
            $options[] = JHTML::_('select.option',$l->name, $l->name);
        }
	return $options;
    }
    
    
     public static  function getMonths(){
        $options[] = JHTML::_('select.option','', '- Month -');
        for ($i=1; $i < 13; $i++){
            $options[] = JHTML::_('select.option',$i, $i);
        }
	return $options;
    }
    
    public static  function getDays(){
        $options[] = JHTML::_('select.option','', '- Day -');
        for ($i=1; $i < 32; $i++){
            $options[] = JHTML::_('select.option',$i, $i);
        }
	return $options;
    }
    
    
    
    public static  function googleMap($cfg = array()){
	
		$html  = '';
		$config = (object) array(
                    'apikey' => 'AIzaSyD7KJAbPjbKDmQxCVsiTlVOmQihmbOoFdY',
                    'long' => ($cfg['lng'])? $cfg['lng'] : '',
                    'lat' => ($cfg['lat'])? $cfg['lat'] : '',
                    'address' => ($cfg['address'])? $cfg['address'] : '',
                    'infotext' => $cfg['address'],
                    'zoom' => 17,
                    'marker' => '',
                    'icon' => ''
                );
                if(!$cfg['id'] || !$config->address){
                    $config->address = '';
                    $config->lat = '48.87146';
                    $config->long = '2.35500';      
                }
                $width = isset($cfg['width'])?$cfg['width']:'600px';
                $height = isset($cfg['height'])?$cfg['height']:'300px';
		$mapid = 'jsmap';
		if(!$config->apikey) return $html;
		$doc = JFactory::getDocument();
		$doc->addScript('http://maps.googleapis.com/maps/api/js?key='.$config->apikey.'&sensor=false');
		$doc->addScript(JURI::root().'administrator/components/com_dtax/assets/js/jsmap.js');
                
                if($config->address != '' && !$config->lat){
                    $script = '
                                var geocoder = new google.maps.Geocoder();
                                geocoder.geocode( { "address": "'.$config->address.'"}, function(results, status) {
                                    if (status == "OK") {
                                        jQuery("#jform_latitude").val(results[0].geometry.location.lat());
                                        jQuery("#jform_longitude").val(results[0].geometry.location.lng());
                                    } else {

                                    }
                                });
                                
                                jQuery(function($){
                                var timex = setInterval(function(){
                                    if(jQuery("#jform_latitude").val() && jQuery("#jform_longitude").val()){
                                        jSont.initialize({
                                            jsmapid		:"'.$mapid.'",
                                            lat			:jQuery("#jform_latitude").val(),
                                            lng			:jQuery("#jform_longitude").val(),
                                            address		:"'.$config->address.'",
                                            zoom		:'.$config->zoom.',
                                            iconmarker	:"'.$config->icon.'",
                                            infotext	:"'.$config->infotext.'",
                                            draggable	:"true",
                                            addevent        : "true"
                                        });
                                        clearInterval(timex);
                                    }
                                }, 100);

                                    
                                });
                            ';
                }else{
                    $script = '
			jQuery(function($){
                            jSont.initialize({
                                jsmapid		:"'.$mapid.'",
                                lat			:"'.$config->lat.'",
                                lng			:"'.$config->long.'",
                                address		:"'.$config->address.'",
                                zoom		:'.$config->zoom.',
                                iconmarker	:"'.$config->icon.'",
                                infotext	:"'.$config->infotext.'",
                                draggable	:"true",
                                addevent        : "true"
                            });
                        });
			';
                }
		$doc->addScriptDeclaration($script);
		$html = '<div style="width:'.$width.'; height: '.$height.';" id="'.$mapid.'"></div>';
		return $html;
	}
	
    public static function getConfig(){
        static $cfg;
        if(isset($cfg)) return $cfg;
        $db = JFactory::getDbo();
        $cfg = $db->setQuery('SELECT * FROM #__dtax_config WHERE id=1')->loadObject();
        $cfg->params = json_decode($cfg->params);
        return $cfg;
    }
    
    
  
    public static function menuSiderbar(){
        $config = self::getConfig();
        $menus = array(
            'companies' => JText::_('COM_DTAX_TITLE_COMPANY'),
            'employees' => JText::_('COM_DTAX_TITLE_EMPLOYEES'),
            'taxreturns' => JText::_('COM_DTAX_TITLE_TAXRETURNS'),
            'emails' => JText::_('COM_DTAX_TITLE_EMAIL'),
            'links' => JText::_('COM_DTAX_TITLE_MENUS'),
            'configs' => JText::_('COM_DTAX_TITLE_CONFIG'),
            
        );
        ob_start();
        ?><div id="DTaxMenu">
            <div class="jMenu-dtax">
                <ul class="jsont-menu">
                    <?php foreach ($menus as $view=>$text){ ?>
                        <?php
                        $page = JFactory::getApplication()->input->getString('view');
                        $selected = '';
                        if($page == $view || $page . 's' == $view) $selected = 'active';
                        if($view == 'companies' && $page == 'company') $selected = 'active';
                        ?>
                        <li class="frontend <?php echo $selected; ?>">
                            <a class="<?php echo $selected; ?>" href="index.php?option=com_dtax&view=<?php echo $view; ?>" title="<?php echo $text; ?>">
                                <img src="<?php echo JURI::root(); ?>components/com_dtax/assets/images/items/<?php echo $view; ?>.png" />
                                <span><?php echo $text; ?></span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
   
    
   public static function accountType($type = null){
        $account = array(
            0 => JText::_('Free'),
            1 => JText::_('VIP'),
        );
        if(isset($account[$type])) return $account[$type];
        return $account;
    }
    
   
    
   public static function repairDb(){
        $db = JFactory::getDbo();
        //$location = "ALTER TABLE `#__mobile_staff` ADD `location` text NOT NULL";
        //if(!self::hasField('#__mobile_staff', 'location')) $db->setQuery($location)->query();
    }
    
    public static function hasField($jtable, $col){
        $db = JFactory::getDbo();
        $column = $db->getTableColumns($jtable); 
        foreach ($column as $c=>$t){
            if($col == $c) return true;
        }
        return false; 
    }
    
    
    
    
}
/**
 * DTax helper.
 */
class DTaxHelper {

    /**
     * Configure the Linkbar.
     */
    public static function addSubmenu($vName = '') {
                JSubMenuHelper::addEntry(
			JText::_('COM_DTAX_TITLE_PROFILES'),
			'index.php?option=com_dtax&view=profiles',
			$vName == 'profiles'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_DTAX_TITLE_REQUESTS'),
			'index.php?option=com_dtax&view=requests',
			$vName == 'requests'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_DTAX_TITLE_WARRIORS'),
			'index.php?option=com_dtax&view=warriors',
			$vName == 'warriors'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_DTAX_TITLE_LINKS'),
			'index.php?option=com_dtax&view=links',
			$vName == 'links'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_DTAX_TITLE_EVENTS'),
			'index.php?option=com_dtax&view=events',
			$vName == 'events'
		);
		

    }


    /**
     * Gets a list of the actions that can be performed.
     *
     * @return	JObject
     * @since	1.6
     */
    public static function getActions() {
        $user = JFactory::getUser();
        $result = new JObject;

        $assetName = 'com_dtax';

        $actions = array(
            'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete'
        );

        foreach ($actions as $action) {
            $result->set($action, $user->authorise($action, $assetName));
        }

        return $result;
    }


}