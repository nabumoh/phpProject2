<?php
// user class includes inputs properties he entered
class User
{

    private string $usersName;
    private string $usersEmail;
    private string $usersUid;
    private string $usersPwd;
    private string $usersPwdRepeat;

    function users(string $usersName, string $usersEmail, string $usersUid, string $usersPwd, string $usersPwdRepeat)
    {
        $this->userName = $usersName;
        $this->userEmail = strtolower($usersEmail);
        $this->userUid = $usersUid;
        $this->userPwd = $usersPwd;
        $this->userPwdRepeat = $usersPwdRepeat;
    }

    public function getUserName():string
    {
        return $this->userName;
    }

    public function getEmail():string
    {
        return $this->userEmail;
    }
    public function getUid():string
     {
         return $this->userUid;
     }

     public function getPwd():string
     {
         return $this->userPwd;
     }

     public function getPwdRepeat():string
     {
         return $this->userPwdRepeat;
     }

     public function setUserName($name)
     {
         $this->userName = $name;
     }

     public function setEmail($email)
     {
         $this->userEmail = $email;
     }

     public function setUid($uid)
     {
         $this->userUid = $uid;
     }

     public function setPwd($usersPwd)
     {
         $this->userPwd = $usersPwd;
     }

     public function setPwdRepeat($pwdRepeat)
     {
         $this->userPwdRepeat = $pwdRepeat;
     }
}
     