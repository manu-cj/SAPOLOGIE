<?php
namespace App\Model\Entity;

class User_role
{
    private int $id;
    private int $user_fk;
    private int $role_fk;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getUserFk(): int
    {
        return $this->user_fk;
    }

    /**
     * @param int $user_fk
     */
    public function setUserFk(int $user_fk): self
    {
        $this->user_fk = $user_fk;
        return $this;
    }

    /**
     * @return int
     */
    public function getRoleFk(): int
    {
        return $this->role_fk;
    }

    /**
     * @param int $role_fk
     */
    public function setRoleFk(int $role_fk): self
    {
        $this->role_fk = $role_fk;
        return $this;
    }

}