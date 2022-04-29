<?php
require __DIR__. '/Engine/Connect.php';

require __DIR__. '/Model/Entity/Character.php';
require __DIR__. '/Model/Entity/Character_image.php';
require __DIR__. '/Model/Entity/Comment.php';
require __DIR__. '/Model/Entity/Mail_validate.php';
require __DIR__. '/Model/Entity/Messages.php';
require __DIR__. '/Model/Entity/Role.php';
require __DIR__. '/Model/Entity/User.php';
require __DIR__. '/Model/Entity/User_role.php';
require __DIR__. '/Model/Entity/View_publication.php';

require __DIR__. '/Model/Manager/Character_imageManager.php';
require __DIR__. '/Model/Manager/CharacterManager.php';
require __DIR__. '/Model/Manager/CommentManager.php';
require __DIR__. '/Model/Manager/Mail_validateManager.php';
require __DIR__. '/Model/Manager/MessagesManager.php';
require __DIR__. '/Model/Manager/RoleManager.php';
require __DIR__. '/Model/Manager/User_roleManager.php';
require __DIR__. '/Model/Manager/UserManager.php';
require __DIR__. '/Model/Manager/View_publicationManager.php';


require __DIR__ . '/Controller/AbstractController.php';
require __DIR__ . '/Controller/CharacterController.php';
require __DIR__. '/Controller/ErrorController.php';
require __DIR__. '/Controller/HomeController.php';
require __DIR__. '/Controller/LoginController.php';
require __DIR__. '/Controller/LogoutController.php';
require __DIR__. '/Controller/RegisterController.php';
require __DIR__. '/Controller/UserController.php';
require __DIR__.'/Controller/SearchController.php';

require __DIR__. '/Routeur/Routeur.php';