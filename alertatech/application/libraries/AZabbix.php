<?php
require_once 'application/third_party/jsonRPCClient.php';
/**
 * Layer interface for zabbix API
 *
 * @author Software Development Team (",);
 */
class AZabbix {

	private $service = 'http://192.168.56.101/zabbix/api_jsonrpc.php';
	#private $service = 'http://173.230.157.196:8080/zabbix/api_jsonrpc.php';
    private $client = null;
    public $error = null;

    public function __construct() {
        $this->client = new jsonRPCClient($this->service);
    }

    private function auth() {
		$res = '';
        $method = 'user.login';
        $params = array(
            'user' => 'admin',
            'password' => 'zabbix',
            'auth' => ''
        );
        try {
            $res = $this->client->$method($params);
        } catch (Exception $error) {
        	echo $error->getMessage();
           // $this->error = $error->getMessage();
            // TODO: error logging
        }
        $_SESSION['zabbix_token'] = $res;
        return $res;
    }

    private function getAuthToken() {
        if (!isset($_SESSION['zabbix_token'])) {
            $this->auth();
        }
        return $_SESSION['zabbix_token'];
    }

    /***
     * $method - Zabbix API method name
     * $params - indexed array of parameters
     */
    public function callAPI($method, $params = array()) {
        $params['auth'] = $this->getAuthToken();
        $res = null;
        try {
            $res = $this->client->$method($params);
        } catch (Exception $error) {
           echo $error->getMessage();
        }
       
        return $res;
    }

    public function info() {
        return $this->callAPI('apiinfo.version');
    }
	
    public function addGroup($name) {
        $res = $this->callAPI('hostgroup.create', array(
            'name' => $name
        ));
        return $res['groupids'][0];
    }
    //adding a host
    public function addHost($name, $ip, $port, $gid) {
    	
        $res = $this->callAPI('host.create', array(
            'host' =>$name,
            'ip' =>$ip,
        	'port'=>$port,
        	'status'=>0,
        	'useip'=>1,
            'groups' => array(
                array('groupid' => $gid)
            )
        ));        
        return $res['hostids'][0];
    }
    //get host property
    public function getHost($hostid)
    {
    	$res = $this->callAPI('trigger.get',array(
    			'hostids'=>$hostid    	
    	));
    	return $res;
    }
    
    //checking a host if already exist (Bug doenst work) 2011-09-04
   /* public function checkHostIfExists($hostname)
    {
    	$res = $this->callAPI('host.exists',array(
    			'hostid' => $hostname   	
    	));
    	echo "<pre>";
    	print_r($res);
    	//return $res;
    }*/
   
    //add imte to zabbix (service)
    public function addItem($probeid,$itemkey,$interval,$description,$itemtype,$history,$trends)
    {
    	$res = $this->callAPI('item.create',array(
    			'description'=>$description,
    			'hostid'=>$probeid,
    			'key_'=>$itemkey,
    			'delay'=>$interval,
    			'type'=>$itemtype,
    			'history'=>$history,
    			'trends'=>$trends,
    			'status'=>0
    	));
    	
    	return $res['itemids'][0];
    }
    //adding trigger to an Item/Probe/Host
    public function addTrigger($description,$expression,$hostid)
    {
    	$res = $this->callAPI('trigger.create',array(
    		'description'=>$description,
    		'expression'=>$expression,
    		'hostid'=>$hostid,
    		'priority'=>4,
    		'status'=>0
    	));
    	return $res;
    }
    
    public function getTriggerByHost($hostid)
    {
    	$res = $this->callAPI('trigger.get',array(
    			'hostids'=>$hostid    	
    	));
    	return $res;
    }
    
    public function getTriggerById($triggerid)
    {
    	$res = $this->callAPI('trigger.get',array(
    			'triggerids'=>$triggerid    	
    	));
    	return $res;
    }
    
    //check if a certain graph already exist for a host    
    public function existsGraph($hostid,$name)
    {
    	$res = $this->callAPI('graph.exists',array(
    			'hostid'=>$hostid,
    			'name'=>$name
    	));
    	return $res;
    }
    
    //get graph details
    public function getGraphById($graphids)
    {
    	$res = $this->callAPI('graphitem.get',array(
    			'output'=>'extend',
    			'graphids'=>$graphids
    	));
    	return $res;
    }
    
   	public function getHistoryUp($items, $from, $to)
    {
    	$res = $this->callAPI('history.get',array(
				'history'=>1,
    			'itemids'=>$items,
				'time_from'=>$from,
				'time_till'=>$to,
    			'output'=>'extend'
    	));
    	return $res;
    }
	public function getHistoryUpByItemId($items, $from, $to)
    {
    	$res = $this->callAPI('history.get',array(
				'history'=>1,
    			'itemids'=>$items,
				'time_from'=>$from,
				'time_till'=>$to,
    			'output'=>'extend'
    	));
    	return $res;
    }
	
	public function getHistoryDown($hostid, $from, $to)
    {
    	$res = $this->callAPI('history.get',array(
				'history'=>0,
    			'hostid'=>$hostid,
				'time_from'=>$from,
				'time_till'=>$to,
    			'output'=>'extend'
    	));
    	return $res;
    }
	
    //check if Service already used/added ($key would be the type of service)
    public function isServiceExists($hostid,$key)
    {
    	$res = $this->callAPI('item.exists',array(
    			'hostid'=>$hostid,
    			'key_'=>$key
    	));
    	return $res;
    }
    
    public function myres() {
    	
    }
}
?>
