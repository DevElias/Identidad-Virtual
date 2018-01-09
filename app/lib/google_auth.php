<?php
    class GoogleAuth{
        
        protected $client;
        public $user;
        
        public function __construct(Google_Client $googleClient = null)
        {
            $this->client = $googleClient;
            
            if($this->client)
            {
                $this->client->setClientID('195002437870-vr27esfdr89bvull4v78eifo0aktot41.apps.googleusercontent.com');
                $this->client->setClientSecret('NIaltIvMzqHyFB1vVW5gDdcl');
                $this->client->setRedirectUri('http://localhost:8080/');
                $this->client->addScope('email');
                $this->client->addScope('profile');
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
            if(isset($_GET['code']))
            {
                $this->client->authenticate($_GET['code']);
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
        
        public function Elias()
        {
            return 'Elias deu merda cara';
        }
    }
?>