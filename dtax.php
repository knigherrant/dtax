<?php 
define('_JEXEC', 1);
define('DS', DIRECTORY_SEPARATOR);
//error_reporting(0);
if (file_exists(dirname(__FILE__) . '/defines.php')) {
	include_once dirname(__FILE__) . '/defines.php';
}
if (!defined('_JDEFINES')) {
	define('JPATH_BASE', dirname(__FILE__));
	require_once JPATH_BASE.'/includes/defines.php';
}
require_once JPATH_BASE.'/includes/framework.php';
$app = JFactory::getApplication('site');
$app->initialise();
require_once  JPATH_SITE.'/components/com_dtax/helpers/dtax.php';

class jSontAjax extends JST{
    function __construct($task = null){
        $respone = $this->isOk(false);
        $this->app = JFactory::getApplication();
		$this->input = $this->app->input;
		JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_dtax/tables');
		$this->limitstart = isset($_REQUEST['limitstart']) ? $_REQUEST['limitstart'] : 0;
		$this->limit = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : 200;
        if(method_exists ($this,$task)) $respone = $this->{$task}();
        die(json_encode($respone));
    }
    /* require name, username, email, password, password2 */
    public function SignUp(){
        //$data  = $this->app->input->post->get('post', array(), 'array');
        $data = $_REQUEST;
        $model = self::getModel('register');
        if($model->save($data)) return $this->isOk (true);
        else return $this->isOk (false);
    }
    function isOk($ok){
        return array('OK' => $ok);
    }
    
    /* require username, password */
    
    public function Login(){
        $credentials = array(
            'username' => $this->app->input->getString('username',''),
            'password' => $this->app->input->getString('password',''),
        );
        $options = array(
            'remember' => true,
            'silent' => true,
        );
        if(true !== $this->app->login($credentials, $options)) return $this->isOk (false);
        $user = jSont::getUser();
		$data = (object) array(
			'OK' => true,
			'user_details' => $user
		);
		return $data;
    }
    
    
    public function addCompany(){
        $data = $_REQUEST;
        $model = self::getModel('company');
        if($model->save($data)) return $this->isOk (true);
        else return $this->isOk (false);
    }
    
	
	/* require all field post like field in database */
    public function addWarrior(){
        $data = $_REQUEST;
        $model = self::getModel('warrior');
        if($model->save($data)) return $this->isOk (true);
        else return $this->isOk (false);
    }
	
    /* get all user infor and testimonials */
    public function getTestimonials(){
        $db = JFactory::getDbo();
        $testimonials = $db->setQuery('SELECT a.*,u.name,u.username,u.email FROM #__prayerline_profiles as a '
                . 'LEFT JOIN #__users as u ON u.id=a.userid ORDER BY a.id LIMIT ' . $this->limitstart . ',' . $this->limit)->loadObjectList();
        return $testimonials;
    }
    
    function getConfigs(){
        return parent::getConfig();
    }
	
}
new jSontAjax($app->input->getString("Action"));
?>
