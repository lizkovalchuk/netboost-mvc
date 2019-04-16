<?php
require_once 'user.php';
require_once 'userRole_DB.php';

class User_DB extends Model
{
    private $userRole;

    public function __construct()
    {
        parent::__construct();
        $this->userRole = new UserRole_DB();
    }

    public function getUserByUserId($userId) : User {
        $query = "SELECT * FROM users WHERE id = :id AND is_active = 1";
        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(":id", $userId, PDO::PARAM_INT);
        $pdostm->execute();

        $userDB = $pdostm->fetch(PDO::FETCH_OBJ);
        $user = new User();
        $user->setId($userDB->id);
        $user->setUsername($userDB->username);
        $user->setPassword($userDB->password);

        $roles = $this->userRole->getRolesByUserId($userDB->id);
        $user->setRoles($roles);

        return $user;
    }

    public function getUserByUsername($username) : ?User {
        $query = "SELECT * FROM users WHERE username = :username AND is_active = 1";
        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(":username", $username, PDO::PARAM_STR);
        $pdostm->execute();

        $userDB = $pdostm->fetch(PDO::FETCH_OBJ);

        if($userDB == null) {
            return null;
        }
        $user = new User();
        $user->setId($userDB->id);
        $user->setUsername($userDB->username);
        $user->setPassword($userDB->password);

        $roles = $this->userRole->getRolesByUserId($userDB->id);
        if(!empty($roles)) {
            $user->setRoles($roles);
        } else {
            echo 'no role assigned!';
        }
        return $user;
    }

    public function addUser(User $user) : User {
        $query = "INSERT INTO users(username, password) 
                        VALUES(:username, :password)";

        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(':username', $user->getUsername());
        $pdostm->bindValue(':password', $user->getPassword());

        if ($pdostm->execute() > 0) {
            $userId = $this->db->lastInsertId();
            $user->setId($userId);
            $user->setPassword(null);
        }

        return $user;
    }

    public function updateUser($id, User $user) : int {
        $query = "UPDATE users SET username = :username, password = :password WHERE id = :id";
        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(":username", $user->getUsername(), PDO::PARAM_STR);
        $pdostm->bindValue(":password", $user->getPassword(), PDO::PARAM_STR);
        $pdostm->bindValue(':id'. $id, PDO::PARAM_INT);

        return $pdostm->execute();
    }

    public function deactivateUser($id) : int {
        $query = "UPDATE users SET is_active = 0 WHERE id = :id";
        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(':id', $id, PDO::PARAM_INT);

        return $pdostm->execute();
    }

    /**
     * updates the reset token in users table when the user clicks forgot password link
     * @param $email
     * @param $token
     * @return int
     */
    public function updateResetPasswordToken($email, $token) : bool {

        $query = 'UPDATE users set password_reset_token = :token WHERE id = 
        (select user_id FROM companies WHERE contact_email = :email UNION SELECT user_id 
        FROM teachers WHERE email = :email UNION SELECT user_id FROM students WHERE 
        email = :email)';

        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(":token", $token, PDO::PARAM_STR);
        $pdostm->bindValue(":email", $email, PDO::PARAM_STR);

        $pdostm->execute();

        return $pdostm->rowCount() > 0;
    }

    public function resetPassword($token, $password) : bool {
        $query = "UPDATE users SET password = :password, password_reset_token = null WHERE password_reset_token = :token";
        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(':password', $password, PDO::PARAM_STR);
        $pdostm->bindValue(':token', $token, PDO::PARAM_STR);

        $pdostm->execute();

        return $pdostm->rowCount() > 0;
    }

    public function doesUserExistsWith($email) : bool {
        $query = "SELECT name FROM companies WHERE contact_email = :email UNION 
                    SELECT first_name FROM teachers WHERE email = :email UNION 
                    SELECT first_name FROM students WHERE email = :email";

        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(':email', $email, PDO::PARAM_STR);
        $pdostm->execute();

        return $pdostm->rowCount() > 0;
    }
}
