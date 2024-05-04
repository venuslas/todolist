<?php
use PHPUnit\Framework\TestCase;

class ProcessTest extends TestCase
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

    public function testInsertQuery()
    {
        //Vérifie si l’insertion d’une nouvelle tâche fonctionne correctement
        $desc = 'Test task';
        $result = mysqli_query($this->dbconfig, "INSERT INTO todo(description) values('$desc')");
        $this->assertTrue($result);
    }

    public function testDeleteQuery()
    {
        // Get the id of the last inserted task
        $result = mysqli_query($this->dbconfig, "SELECT id FROM todo ORDER BY id DESC LIMIT 1");
        $row = mysqli_fetch_assoc($result);
        $delete_id = $row['id'];

        $result = mysqli_query($this->dbconfig, "DELETE FROM todo WHERE id=$delete_id");
        $this->assertTrue($result);
    }

    public function testUpdateQuery()
    {
        // Get the id of the last inserted task
        $result = mysqli_query($this->dbconfig, "SELECT id FROM todo ORDER BY id DESC LIMIT 1");
        $row = mysqli_fetch_assoc($result);
        $edit_id = $row['id'];

        $new_desc = 'Updated task';
        $result = mysqli_query($this->dbconfig, "UPDATE todo SET description='$new_desc' WHERE id=$edit_id");
        $this->assertTrue($result);
    }

    public function testCheckQuery()
    {
        // Get the id of the last inserted task
        $result = mysqli_query($this->dbconfig, "SELECT id FROM todo ORDER BY id DESC LIMIT 1");
        $row = mysqli_fetch_assoc($result);
        $checked_id = $row['id'];

        $result = mysqli_query($this->dbconfig, "UPDATE todo SET status=1 WHERE id=$checked_id");
        $this->assertTrue($result);
    }
}
?>
