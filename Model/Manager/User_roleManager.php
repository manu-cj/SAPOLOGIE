<?php


class User_roleManager
{

    public static function getUserRole() {
        $get = Connect::getPDO()->prepare("SELECT * FROM aiu12_user_role WHERE user_fk = :user_fk");
        $get->bindValue(':user_fk', $_SESSION['user']['id']);
        if ($get->execute()) {

            $datas = $get->fetchAll();
            foreach ($datas as $data) {
                $get = Connect::getPDO()->prepare("SELECT * FROM aiu12_role WHERE id = :id");
                $get->bindValue(':id', $data['role_fk']);
                if ($get->execute()) {
                    $datas2 = $get->fetchAll();
                    foreach ($datas2 as $data2) {
                        $_SESSION['role'] = $data2;
                    }
                }

                echo $_SESSION['role']['role'];
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