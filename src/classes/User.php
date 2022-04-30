<?php
include 'classes/Database.php';
class User extends Database {
    function insertUser ($name,$email,$hash,$user_type,$status){
        $stmt = $this->_mysqli->prepare("INSERT INTO users (name,email,password,user_type,status )VALUES (?,?,?,?,?)");        
        $stmt->bind_param("sssss",$name,$email,$hash,$user_type,$status);
        return $stmt->execute();

    }
    function updateUser($name, $email,$user_type, $status, $updated_at,$id)
    {
        $stmt = $this->_mysqli->prepare("UPDATE users SET name=?,email=?,user_type=?,status=?,updated_at=?  where id =?");
        $stmt->bind_param("sssssi", $name, $email, $user_type, $status, $updated_at,$id);
        return $stmt->execute();
    }
    function deleteUser($id)
    {
        $stmt = $this->_mysqli->prepare("DELETE FROM users WHERE id=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    function fetchUser($offset,$limit)
    {  
        $stmt = $this->_mysqli->prepare("SELECT * FROM users LIMIT ?, ?");
        $stmt->bind_param("ii", $offset,$limit);
        $stmt->execute();
        $query = $stmt->get_result();
        return $query;
    }
    function editUser($id)
    {
        $stmt = $this->_mysqli->prepare("SELECT * FROM users WHERE id=?");
        $stmt->bind_param("i", $id);
         $stmt->execute();
         $query = $stmt ->get_result();
         return $query;
    }
    function login($email)
    {
        $stmt = $this->_mysqli->prepare("SELECT * FROM users WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $query = $stmt->get_result();
        return $query;
    }
     function fetchCount()
    {
        $stmt = $this->_mysqli->prepare('SELECT count(*) FROM users');
        $stmt->execute();
        $query = $stmt->get_result();
        $row = $query->fetch_assoc();
        $saved = $row['count(*)'];
        return $saved;
    }
    function fetchAll()
    {
        $stmt = $this->_mysqli->prepare("SELECT * FROM users ");      
        $stmt->execute();
        $query = $stmt->get_result();
        return $query;
    }
}
?>