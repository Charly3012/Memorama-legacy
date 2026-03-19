<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ ."/../core/php/interfaces/DatabaseInterface.php";
require_once __DIR__ ."/../core/php/interfaces/SessionInterface.php";
require_once __DIR__ ."/../core/php/services/AuthService.php";

class AuthServiceTest extends TestCase {
    
    private $dbMock;
    private $sessionMock;
    private $authService;

    protected function setUp(): void {
        $this->dbMock = $this->createMock(DatabaseInterface::class);
        $this->sessionMock = $this->createMock(SessionInterface::class);
        
        $this->authService = new AuthService($this->dbMock, $this->sessionMock);
    }

    /**
     * Prueba Positiva: El usuario existe y las credenciales son correctas.
     */
    public function testExecuteLoginSuccess() {
    $username = 'usuario_test';
    $password = 'password123';
    
    $userData = [
        ['id' => 123, 'tipo' => 'admin', 'nombre' => $username]
    ];

    $expectedQuery = "SELECT * FROM usuario WHERE nombre = '$username' AND clave = '$password'";

    $this->dbMock->expects($this->once())
        ->method('realizeQuery')
        ->with($expectedQuery) // 
        ->willReturn($userData);

    $result = $this->authService->login($username, "password123");

    $this->assertIsArray($result);
    $this->assertEquals('admin', $result[0]['type']);
}

    /**
     * Prueba Negativa: El usuario no existe o la clave es incorrecta.
     */
    public function testExecuteLoginFailure() {
        $this->dbMock->expects($this->once())
            ->method('realizeQuery')
            ->willReturn([]);

        $this->sessionMock->expects($this->never())
            ->method('set');

        $result = $this->authService->login('hacker', 'wrong_pass');

        $this->assertNull($result);
    }
}