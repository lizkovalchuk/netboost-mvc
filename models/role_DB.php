<?php
require_once 'role.php';

class Role_DB extends Model
{

    public function getRoleById(int $roleId) : Role {
        $query = "SELECT * FROM roles WHERE id = :id";
        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(":id", $roleId, PDO::PARAM_INT);
        $pdostm->execute();

        $roleDB = $pdostm->fetch(PDO::FETCH_OBJ);
        $role = new Role();
        $role->setId($roleDB->id);

        return $role;
    }

    public function getAllRoles() : array {
        $query = "SELECT * FROM user_roles";

        $pdostm = $this->db->prepare($query);
        $pdostm->execute();
        $rolesDB = $pdostm->fetchAll(PDO::FETCH_OBJ);

        $roles = array();

        foreach ($rolesDB as $r) {
            $role = new Role();
            $role->setId($r->id);
            $role->setName($r->name);

            array_push($roles,$role);
        }
        return $roles;
    }

    /**
     * restricting user from signing up as admin(role id = 1)
     * @param int $roleId
     * @return bool
     */
    public static function isAllowedRole(int $roleId) : bool {
        return ($roleId == 2) || ($roleId == 3) || ($roleId == 4);
    }
}