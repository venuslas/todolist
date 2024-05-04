<?php
use PHPUnit\Framework\TestCase;

class ListTest extends TestCase
{
    private $dbconfig;

    protected function setUp(): void
    {
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'dm';
        $this->dbconfig = mysqli_connect($host,$username,$password,$database);
    }

    public function testDatabaseConnection()
    { 
        //Vérifier si la connexion à la base de données a été établie correctement
        $this->assertNotNull($this->dbconfig);
    }

    public function testSelectQuery()
    {
        /*Vérifie si la requête SQL “SELECT * FROM todo” s’exécute sans erreur en vérifiant si le résultat est une instance de mysqli_result à la place*/
        $result = mysqli_query($this->dbconfig, "SELECT * FROM todo");

        if (!$result) {
            die('Erreur: ' . mysqli_error($this->dbconfig));
        }

        $this->assertInstanceOf(mysqli_result::class, $result);
    }


}
?>
