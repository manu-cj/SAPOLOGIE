<?php


class User_roleManager
{

    public static function getUserRole() {
        $get = Connect::getPDO()->prepare("SELECT * FROM aiu12_user_role WHERE user_fk = :user_fk");
        $get->bindValue(':user_fk', $_SESSION['user']['id']);
        if ($get->execute()) {
            $datas = $get->fetchAll();
            foreach ($datas as $data) {
                $_SESSION['role'] = $data['role_fk'];
                echo $_SESSION['role'];
            }
        }
    }

    public static function addRole() {
        $insert = Connect::getPDO()->prepare("INSERT INTO aiu12_user_role (user_fk, role_fk) VALUES (:user_fk, :role_fk)");
        $insert->bindValue(':user_fk', $_SESSION['user']['id']);
        $insert->bindValue(':role_fk', 1);
        $insert->execute();
    }

    public static function deleteRole($id) {
        $delete = Connect::getPDO()->prepare("DELETE FROM aiu12_user_role WHERE user_fk = :user_fk");
        $delete->bindValue(':user_fk', $id);
        $delete->execute();
    }
}