
<form action="?c=profil&a=add-character" method="post" id="register">
    <table>
        <tr>
            <td><label for="username">Nom du personnage :</label></td>
            <td><input type="text" name="username" id="username" required></td>
        </tr>
        <tr>
            <td><label for="class">Classe du personnage :</label> </td>
            <td>
                <select required>
                    <option value="default"></option>
                    <option value="guerrier">Guerrier</option>
                    <option value="paladin">Paladin</option>
                    <option value="Mage">Mage</option>
                    <option value="Voleur">Voleur</option>
                    <option value="Druide">Druide</option>
                    <option value="Chaman">Chaman</option>
                    <option value="Demoniste">Demoniste</option>
                    <option value="Moine">Moine</option>
                    <option value="Chevalier-de-la-mort">Chevalier-de-la-mort</option>
                    <option value="Chasseur">Chasseur</option>
                    <option value="Pretre">Pretre</option>
                    <option value="Chasseur-de-demon">Chasseur-de-demon</option>
                </select>
            </td>
        </tr>
        <input type="text" name="user-fk" value="<?=$_SESSION['username']?>" style="display: none">

    </table>
    <input type="submit" value="Ajouter">
</form>

