<?php
require_once 'user.php';
require_once 'role.php';
require_once 'role_DB.php';

class UserRole_DB extends Model
{
    private $roleDB;

    public function __construct() {
        parent::__construct();
        $this->roleDB = new Role_DB();
    }

    public function addUserRole(User $user, int $roleId) : User {
        $query = "INSERT INTO user_roles(user_id, role_id) 
                        VALUES(:userId, :roleId)";

        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(':userId', $user->getId());
        $pdostm->bindValue(':roleId', $roleId);

        if ($pdostm->execute() > 0) {

            $roles = array();
            array_push($roles, $this->roleDB->getRoleById($roleId));
            $user->setRoles($roles);
            $user->setPassword(null);
        }

        return $user;
    }

    /**
     * @param int $userId
     * @return array of roles
     */
    public function getRolesByUserId(int $userId) : array {
        $query = "SELECT r.* FROM user_roles ur JOIN roles r WHERE ur.role_id = r.id AND ur.user_id = :userId";
        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(":userId", $userId, PDO::PARAM_INT);
        $pdostm->setFetchMode(PDO::FETCH_OBJ);
        $pdostm->execute();

        $rolesDB = $pdostm->fetchAll();
        $roles = array();

        foreach ($rolesDB as $r) {
            $role = new Role();
            $role->setId($r->id);
            $role->setName($r->name);

            array_push($roles, $role);
        }
        return $roles;
    }

}