<?php
class authentificationController{
    private $userdao;
    public function __construct(){
        $this->userdao=new UserDao();
    }
    public function LoginForm(){
        include_once 'app/View/authentification/signin.php';
    }
    public function signin(){
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $email=$_POST['email'];
            $password=$_POST['password'];
            $user=$this->userdao->authentification($email,$password);
            $_SESSION['iduser']=$user->getID();
            if($user){
                $type=$user->getRole();
                switch($type){
                    case 'admin':
                        header('Location:');
                        break;
                    case 'author':
                        header('Location:');
                        break;
                    default:
                        header('Location:');
                        break;
                }

            }

        }else{
            $loginfaild='error mot passe or email';
            include_once 'app/View/authentification/signin.php';
        }
    }
    public function RegistrationForm(){
        include_once 'app/View/authentification/signup.php';
    }
    public function Registration(){
        $name=$_POST['nom'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        $user=new user(0,$name,$email,$password,0);
        $this->userdao->addUser($user);
        
    }
    public function logout(){
    session_start();
    session_unset();
    session_destroy();
    header('location:signin.php');
    exit();
    }

}