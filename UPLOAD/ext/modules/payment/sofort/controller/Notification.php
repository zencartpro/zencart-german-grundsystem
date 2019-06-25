<?php

require_once(dirname(__FILE__) . '/../services/Communication.php');

require_once(dirname(__FILE__) .  '/../../../../../includes/modules/payment/sofort_su.php');

class Notification
{    
    
    /**
     * @var array
     */
    private $request = array();
    
    /**
     * @var string
     */
    private $rawBody;
    
    /**
     * @param array $request
     */
    public function __construct(array $request, $rawBody)
    {
        $this->request = $request;
        $this->rawBody = $rawBody;

    }
    
    /**
     * @return mixed
     */
    private function _getRequest($key = null)
    {
        $data = '';
        
        if (is_null($key)) {
            $data = $this->request; 
        } elseif (array_key_exists($key, $this->request)) {
            $data = $this->request[$key];
        }
        
        return $data;
    }
    
    /**
     * @return string
     */
    private function _getRawBody()
    {
        return $this->rawBody;
    }

    /**
     * sofort_notification.php?action=notification url
     */
    public function notificationAction()
    {
        $communication = new Communication(new sofort_su());
        $communication->handleSofortStatusUpdate(
            $communication->getStatusData($this->_getRawBody())
        );
        
        exit('complete');
    }
    

}