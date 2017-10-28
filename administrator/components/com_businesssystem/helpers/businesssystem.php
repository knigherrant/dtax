<?php

/**
 * @version     1.0.0
 * @package     com_businesssystem
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
class jSont extends BusinessSystemHelper{
    
    
    
    public static $file_ext =  array(
        'archive' => array('7z', 'ace', 'bz2', 'dmg', 'gz', 'rar', 'tgz', 'zip'),
        'document' => array('csv', 'doc', 'docx', 'html', 'key', 'keynote', 'odp', 'ods', 'odt', 'pages', 'pdf', 'pps', 'ppt', 'pptx', 'rtf', 'tex', 'txt', 'xls', 'xlsx', 'xml'),
        'image' => array('bmp', 'exif', 'gif', 'ico', 'jpeg', 'jpg', 'png', 'psd', 'tif', 'tiff'),
        'audio' => array('aac', 'aif', 'aiff', 'alac', 'amr', 'au', 'cdda', 'flac', 'm3u', 'm3u', 'm4a', 'm4a', 'm4p', 'mid', 'mp3', 'mp4', 'mpa', 'ogg', 'pac', 'ra', 'wav', 'wma'),
        'video' => array('3gp', 'asf', 'avi', 'flv', 'm4v', 'mkv', 'mov', 'mp4', 'mpeg', 'mpg', 'ogg', 'rm', 'swf', 'vob', 'wmv')
    );
    
    
     public static function saveUser($data, $name =''){
        $user = new JUser();
        if(!$name) $name = $data['firstname'] . ' ' . $data['midname'] . ' ' . $data['lastname'];
        $uData = array(
            'username' => $data['email'],
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
            if($user->getErrors('errors')) {
                    foreach ($user->getErrors('errors') as $msg) JFactory::getApplication()->enqueueMessage($msg, 'error');
            }
        }
        return false;
    }

    public static function editUser($userid, $data){
        $user = new JUser($userid);
        $uData = array();
        if($data['password']){
            $uData['password'] = $data['password'];
            $uData['password2'] = $data['password'];
        }
        if($data['email']) if($user->email != $data['email']) $uData['email'] = $data['email'];
        if($data['username']) if($user->username != $data['username']) $uData['username'] = $data['username'];
        if($user->bind($uData)){
            if($user->save()){
                return $user;
            }
			if($user->getErrors('errors')) {
				foreach ($user->getErrors('errors') as $msg) JFactory::getApplication()->enqueueMessage($msg, 'error');
			}
        }
        return false;

    }
    
    
    
    
    public static function getFileType($file){
        $pathinfo = pathinfo($file);
        $extension = strtolower(@$pathinfo['extension']);
        $imageTypes = array('bmp','exif','gif','ico','jpeg','jpg','png','psd','tif','tiff');
        $icon = JURI::root().'administrator/components/com_businesssystem/assets/images/file-icons/'.$extension.'.png';
        if(!is_file(JPATH_SITE.'/administrator/components/com_businesssystem/assets/images/file-icons/'.$extension.'.png'))
            $icon = JURI::root().'administrator/components/com_businesssystem/assets/images/file-icons/_blank.png';
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
        
        $document->addScript(JUri::root().'administrator/components/com_businesssystem/assets/libs/knockout.js');
        $document->addScript(JUri::root().'administrator/components/com_businesssystem/assets/libs/underscore-min.js');
        $document->addScript(JUri::root().'administrator/components/com_businesssystem/assets/libs/knockout.simpleGrid.js');
        $document->addScript(JUri::root().'administrator/components/com_businesssystem/assets/js/jquery.noconflict.js');
        $document->addStyleSheet(JUri::root().'administrator/components/com_businesssystem/assets/libs/font-awesome/css/font-awesome.css');
       
		$document->addStyleSheet(JUri::root().'administrator/components/com_businesssystem/assets/libs/plupload/js/jquery.plupload.queue/css/jquery.plupload.queue.css');
		$document->addScript(JUri::root().'administrator/components/com_businesssystem/assets/libs/plupload/js/plupload.full.min.js');
		$document->addScript(JUri::root().'administrator/components/com_businesssystem/assets/libs/plupload/js/jquery.plupload.queue/jquery.plupload.queue.js');
		$document->addScript(JUri::root().'administrator/components/com_businesssystem/assets/js/files.js');
		$document->addStyleSheet(JUri::root().'administrator/components/com_businesssystem/assets/css/files.css');
                   
    }
	
	
    
    
    public static  function loadAdminCss(){
        $document = JFactory::getDocument();
        //$document->addStyleSheet(JURI::root() . 'components/com_businesssystem/assets/css/businesssystem-frontend.css');
        $document->addStyleSheet(JURI::root() . 'administrator/components/com_businesssystem/assets/css/businesssystem.css');
        $document->addScript(JUri::root().'administrator/components/com_businesssystem/assets/js/jquery.noconflict.js');
        $document->addScript(JURI::root() . 'components/com_businesssystem/assets/js/businesssystem.js');
        $document->addScript(JURI::root() . 'administrator/components/com_businesssystem/assets/js/js.js');
        self::upgradePermission();
		
    }
    
	
    public static  function loadFrontEndCss(){
        $document = JFactory::getDocument();
        $document->addStyleSheet(JURI::root() . 'components/com_businesssystem/assets/css/businesssystem-frontend.css');
        $document->addScript(JUri::root().'administrator/components/com_businesssystem/assets/js/jquery.noconflict.js');
        $document->addScript(JURI::root() . 'components/com_businesssystem/assets/js/businesssystem.js');
        $document->addScript(JURI::root() . 'administrator/components/com_businesssystem/assets/js/js.js');
    }
    
    public static function upgradePermission(){
        $db = JFactory::getDbo();
        $db->setQuery('UPDATE #__assets SET rules=' . $db->quote('{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1,"2":1},"core.delete":{"2":1},"core.edit":{"4":1,"2":1},"core.edit.state":{"5":1,"2":1},"core.edit.own":{"2":1}}') . ' WHERE name=' . $db->quote('com_businesssystem'))->execute(); 
    }
    
    public static function getTable($table){
        JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_businesssystem/tables');
        return JTable::getInstance(ucwords($table),'BusinessSystemTable');
    }
    
    public static function getModel($model){
        JModelLegacy::addIncludePath(JPATH_SITE . '/components/com_businesssystem/models', 'BusinessSystemModel');
        return JModelLegacy::getInstance(ucwords($model), 'BusinessSystemModel', array('ignore_request' => true));
    }
   
    
    public static function getOptionCustomer(){
        $db = JFactory::getDbo();
        $lists = $db->setQuery('SELECT CONCAT(firstname," ",midname," ",lastname) as name, id   FROM #__businesssystem_customers ')->loadObjectList();
        $options[] = JHTML::_('select.option','', '- Select Customer -');
        foreach ($lists as $l){
            $options[] = JHTML::_('select.option',$l->id, $l->name);
        }
	return $options;
    }
    
    public static function getOptionAccount(){
        $db = JFactory::getDbo();
        $lists = $db->setQuery('SELECT CONCAT(firstname," ",midname," ",lastname) as name, id   FROM #__businesssystem_accounts ')->loadObjectList();
        $options[] = JHTML::_('select.option','', '- Select Account -');
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
            return JUri::root().'administrator/components/com_businesssystem/assets/images/file-icons/'.$fileName;
        }
        return JUri::root().'administrator/components/com_businesssystem/assets/images/file-icons/_blank.png';
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
	
        
        
	
    
    public static  function format($date){
        return JHtml::_('date', $date, JText::_('DATE_FORMAT_LC3'), false);
    }
    
	
    public static  function getProducts(){
        $products = json_decode(jSont::getConfig()->products);
        $options[] = JHTML::_('select.option','', '- Select Product -');
        foreach ($products as $l){
            $options[] = JHTML::_('select.option',$l->name, $l->name);
        }
	return $options;
                
    }
    
    public static  function getOrderStatus(){
        $orderstatus = json_decode(jSont::getConfig()->orderstatus);
        $options[] = JHTML::_('select.option','', '- Select Order Status -');
        foreach ($orderstatus as $l){
            $options[] = JHTML::_('select.option',$l->name, $l->name);
        }
	return $options;
                
    }
    
   
    public static function getConfig(){
        static $cfg;
        if(isset($cfg)) return $cfg;
        $db = JFactory::getDbo();
        $cfg = $db->setQuery('SELECT * FROM #__businesssystem_config WHERE id=1')->loadObject();
        $cfg->params = json_decode($cfg->params);
        return $cfg;
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
 * BusinessSystem helper.
 */
class BusinessSystemHelper {

    /**
     * Configure the Linkbar.
     */
    public static function addSubmenu($vName = '') {
            JHtmlSidebar::addEntry(  JText::_('Accounts'),  'index.php?option=com_businesssystem&view=accounts', $vName == 'accounts'  );
            JHtmlSidebar::addEntry(  JText::_('Orders'),  'index.php?option=com_businesssystem&view=orders',  $vName == 'orders'  );
            JHtmlSidebar::addEntry(  JText::_('Documents'),  'index.php?option=com_businesssystem&view=documents',  $vName == 'documents'  );
            JHtmlSidebar::addEntry(  JText::_('Companies'),  'index.php?option=com_businesssystem&view=companies',  $vName == 'companies'  );
            JHtmlSidebar::addEntry(  JText::_('Categories'),  'index.php?option=com_businesssystem&view=categories',  $vName == 'categories'  );
            JHtmlSidebar::addEntry(  JText::_('Email Templates'),  'index.php?option=com_businesssystem&view=templates',  $vName == 'templates'  );
            JHtmlSidebar::addEntry(  JText::_('Configs'),  'index.php?option=com_businesssystem&view=configs',  $vName == 'configs'  );
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

        $assetName = 'com_businesssystem';

        $actions = array(
            'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete'
        );

        foreach ($actions as $action) {
            $result->set($action, $user->authorise($action, $assetName));
        }

        return $result;
    }


}
