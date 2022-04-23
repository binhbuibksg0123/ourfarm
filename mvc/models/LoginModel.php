<?php
class LoginModel extends DB{
    public function login($username,$pass){
        $query = "select * from customers
                  where email = '".$username."' and password = '".$pass."'";
        $result = $this->con->query($query);
        if($result->num_rows == 0){
            return 0;
        }
        else return 1;
    }
}
?>