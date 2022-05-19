<?php
require __DIR__. '/../../../vendor/autoload.php';
require __DIR__. '/../../../Model/Entity/User.php';
use App\Model\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public User $user;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
    }

    public function testSetUsername() {
    $name = 'Joseph';
    $user = new User;
    $user->setUsername($name);
    $this->assertEquals($name, $user->getUsername());
    }

    public function testSetId() {
        $id = 1;
        $user = new User;
        $user->setId($id);
        $this->assertEquals($id, $user->getId());
    }

    public function testSetMail() {
        $mail = 'Joseph@gmail.com';
        $user = new User;
        $user->setMail($mail);
        $this->assertEquals($mail, $user->getMail());
    }


    public function testSetPassword() {
        $password = 'lemotdepasse';
        $user = new User;
        $user->setPassword($password);
        $this->assertEquals($password, $user->getPassword());
    }


}