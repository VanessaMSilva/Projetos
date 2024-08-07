<?php
    class User{
        public $id;
        public $name;
        public $lastname;
        public $email;
        public $password;
        public $image;
        public $bio;
        public $img;
        public $token;

        public function generateToken(){
            return bin2hex(random_bytes(50));
        }

        public function setName($name){
            $this->name = $name;
        }

        public function generatePassword($password){
            return password_hash($password, PASSWORD_DEFAULT);
        }
    }

    interface UserDAOInterface{
        public function buildUser($data);
        public function create(User $user, $authUser = false);
        public function update(User $user);
        public function verifyToken($protected= false);
        public function setTokenToSession($token, $redirect = true);
        public function authenticateUser($email, $password);
        public function findByToken($token);
        public function findByEmail($email);
        public function findById($id);
        public function changePassword(User $user);







    }
?>