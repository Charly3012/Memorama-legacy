<?php

class AuthService{
    private $db; 
    private $session;

    public function __construct(DatabaseInterface $database, SessionInterface $session)
    {
        $this->db = $database;
        $this->session = $session;
    }

    public function login($username, $password)
    {
        $query = "SELECT * FROM usuario WHERE nombre = '$username' AND clave = '$password'";
        $result = $this->db->realizeQuery($query);

        return $this->verifyLogin($result);
    }

    public function verifyLogin($result)
    {
        if(count($result) > 0) 
        {
            $user = ['type' => $result[0]['tipo']];
            $this->session->set('user', $result[0]['id']);
            return [$user];
        }
        return null;
    }
}