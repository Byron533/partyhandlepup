<?php
class Database {
    private static $dsn = 'mysql:host=sql2.njit.edu;dbname=bl54';
    private static $username = 'bl54';
    private static $password = '4qIHGWPk';
    private static $db;
    private function __construct() {}
    public static function getDB () {
        if (!isset(self::$db)) {
            try {
                self::$db = new PDO(self::$dsn,
                                     self::$username,
                                     self::$password);
            } catch (PDOException $e) {
                $error_message = $e->getMessage();
                echo $error_message;
                exit();
            }
        }
        return self::$db;
    }
}

    class User {
        private $id;
        private $email;
        private $fname;
        private $lname;
        private $phone;
        private $birthday;
        private $gender;
        private $password;

        public function __construct($id, $email, $fname, $lname, $phone, $birthday, $gender, $password){
            $this->id = $id;
            $this->email = $email;
            $this->fname = $fname;
            $this->lname = $lname;
            $this->phone = $phone;
            $this->birthday = $birthday;
            $this->gender = $gender;
            $this->password = $password;
        }


        public function getid (){
            return $this->id;
        }
        public function setid($value){
            $this ->id = $value;
        }

        public function getEmail (){
            return $this->email;
        }
        public function setEmail($value){
            $this ->email = $value;
        }

        public function getFname (){
            return $this->fname;
        }
        public function setFname($value){
            $this ->fname = $value;
        }

        public function getLname (){
            return $this->lname;
        }
        public function setLname($value){
            $this ->lname = $value;
        }

        public function getPhone (){
            return $this->phone;
        }
        public function setPhone($value){
            $this ->phone = $value;
        }

        public function getBirthday (){
            return $this->birthday;
        }
        public function setBirthday($value){
            $this ->birthday = $value;
        }

        public function getGender (){
            return $this->gender;
        }
        public function setGender($value){
            $this ->gender = $value;
        }

        public function getPassword (){
            return $this->password;
        }
        public function setPassword ($value){
            $this ->password = $value;
        }
        public function displayUserRow(){
            $id = $this->id;
            $email = $this->email;
            $fname = $this->fname;
            $lname = $this->lname;
            $phone = $this->phone;
            $birthday = $this->birthday;
            $gender = $this->gender;
            $password = $this->password;
            return "<tr> <td>$id</td><td> $email</td><td>$fname</td><td>$lname</td><td>$phone</td><td>$birthday</td><td>$gender</td><td>password</td></tr> ";
        }

    }

    class UsersDB {
        public static function getUsers(){
            $db = Database :: getDB();
            $query = 'SELECT * FROM bl54.accounts';
            $statement = $db->prepare($query);
            $statement -> execute();
            $results = $statement -> fetchAll();
            $statement -> closeCursor();

            $users = array();

            foreach($results as $row){
                $users[] = new User($row['id'], $row['email'], $row['fname'], $row['lname'], $row['phone'], $row['birthday'], $row['gender'], $row['password'] );
            }


            return $users;
        }
        public static function insertUser($user){
            $db = Database :: getDB();
            $id = $user-> getID();
            $email = $user-> getEmail();
            $fname = $user-> getFname();
            $lname = $user-> getLname();
            $phone = $user-> getPhone();
            $birthday = $user-> getBirthday();
            $gender = $user-> getGender();
            $password = $user-> getPassword();

            $query = 'INSERT INTO bl54.accounts (id, email, fname, lname, phone, birthday, gender) VALUES (:id, :email, :fname, :lname, :phone, :birthday, :gender, :password) ';
            $statement = $db -> prepare($query);
            $statement -> bindValue(':id', $id);
            $statement -> bindValue(':email', $email);
            $statement -> bindValue(':fname', $fname);
            $statement -> bindValue(':lname', $lname);
            $statement -> bindValue(':phone', $phone);
            $statement -> bindValue(':birthday', $birthday);
            $statement -> bindValue(':gender', $gender);
            $statement -> bindValue(':password', $password);
            $statement -> execute();
            $statement -> closeCursor();
        }
        public static function updateUser(){
            $db = Database :: getDB();
            $query = 'UPDATE bl54.accounts SET password = :password WHERE id = :id';

            $statement = $db->prepare($query);
            $statement -> bindValue(':password', $password);
            $statement -> bindValue(':id', $id);
            $statement -> execute();
            $statement -> closeCursor();



        }
        public static function deleteUser($user){
            $db = Database :: getDB();
            $query = 'DELETE FROM bl54.accounts WHERE id = :id';
            $id = $user-> getID();
            $statement = $db->prepare($query);
            $statement -> bindValue(':id', $id);
            $statement -> execute();
            $statement -> closeCursor();

        }


    }

    $users = UsersDB::getUsers();
?>
<html>
    <head>
        <title>Week 9 Assignmnet</title>
        <link rel="stylesheet" href="main.css">
    </head>
    <style>
    table, th, td { 
            border: 1px solid black;
            border-collapse: collapse;
     }
 </style>
    <body>
        <table class="user-table">
            <tr>
                <th>ID</th>
                <th>email</th>
                <th>fname</th>
                <th>lname</th>
                <th>phone</th>
                <th>birthdate</th>
                <th>gender</th>
                <th>password</th>
            </tr>   
            <?php foreach ($users as $user) : ?>
                <?php echo $user->displayUserRow(); ?>
            <?php endforeach; ?>        
        </table>
    </body>     
</html>