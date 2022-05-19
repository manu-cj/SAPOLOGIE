<?php

use PHPUnit\Framework\TestCase;



class RegisterControllerTest extends TestCase
{
    private RegisterController $registerController;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
    }

    public function testIndex()
    {
        $username = strtolower(trim(htmlentities('testManu123')));
        $mail = trim(htmlentities(('Test@gmail.com')));

        $this->assertNotNull($username, $mail);
    }
}