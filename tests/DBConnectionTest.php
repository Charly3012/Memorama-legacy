<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../core/php/DataBaseManager.php';

class DBConnectionTest extends TestCase {
    
    public function testInstanciaYConexion() {
        $db = DataBaseManager::getInstance();
        
        $this->assertInstanceOf(DataBaseManager::class, $db);
        
        $resultado = $db->realizeQuery("SELECT 1");
        $this->assertNotNull($resultado, "La base de datos debería responder a una consulta simple.");
    }

    public function testConsultaErronea() {
        $db = DataBaseManager::getInstance();
        
        $resultado = $db->realizeQuery("SELECT * FROM tabla_fantasma_inexistente");
        
        $this->assertNull($resultado, "Una consulta fallida debería retornar null según la lógica de la clase.");
    }
}