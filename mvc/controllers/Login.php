<?php
class Login extends Controller{
    private $userModel;
    function __construct(){
        $this->userModel = $this->model("LoginModel");
    }
    function mainFunc($loginStatus = true){
        $this->view("LoginLayout",["loginStatus"=>$loginStatus]);
    }
    function loginHandling(){
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $result = $this->userModel->login($email,$pass);
        if($result == 1) {
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            // require_once "./mvc/controllers/Dashboard.php";
            // call_user_func_array([new Dashboard,"mainFunc"], []); 
            header("LOCATION: http://localhost/ourfarm/dashboard");
        }
        else{
            $_SESSION['loggedin'] = false;
            $_SESSION['email'] = $email;
            call_user_func_array([new Login,"mainFunc"],[false]);
        }
    }
}
?>