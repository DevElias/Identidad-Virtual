<?php
    class GoogleAuth{
        
        protected $client;
        public $user;
        
        public function __construct(Google_Client $googleClient = null)
        {
            $this->client = $googleClient;
            
            if($this->client)
            {
                $this->client->setClientID('195002437870-rp8bdf09m6uaan83vr7g9gs7cpalavsd.apps.googleusercontent.com');
                $this->client->setClientSecret('WhuxYHQe2sdbEx3OSaOK-25-');
                $this->client->setRedirectUri('https://login.techo.org');
                $this->client->addScope('email');
            //    $this->client->addScope('profile');
            }
        }
        
        public function isLoggedIn()
        {
            return isset($_SESSION['access_token']);
        }
        
        public function getAuthUrl()
        {
            return $this->client->createAuthUrl();
        }
        
        public function checkRedirectCode()
        {
		//	echo('<pre>');
		//	die(print_r($_GET, true));
			
            if(isset($_GET['code']))
            {
                $this->client->authenticate($_GET['code']);
                							
                $aDados = $this->client->getAccessToken();
				
                $this->setToken($this->client->getAccessToken());
                
                $this->setUser($this->getPayload());
                
                $payload = $this->getPayload();
                
                return true;
            }
            return false;
        }
        
        public function setToken($token)
        {
            $_SESSION['access_token'] = $token;
            $this->client->setAccessToken($token);
        }
		
		public function setUser($user)
		{
            
			$_SESSION['user'] = $user;
		}
		
		public function getUser()
        {
            return isset($_SESSION['user']);
        }
        
        public function Logout()
        {
            unset($_SESSION['access_token']);
        }
        
        public function getPayload()
        {
            
            $payload = $this->client->verifyIdToken();
            
            if($payload)
            {
                return $payload;
            }
        }
    }
?>