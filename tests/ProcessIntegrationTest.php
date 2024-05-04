<?php
use PHPUnit\Framework\TestCase;

class ProcessIntegrationTest extends TestCase
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

    public function testTaskLifecycle()
    {
        // Insert a new task
        $desc = 'Test task';
        $result = mysqli_query($this->dbconfig, "INSERT INTO todo(description) values('$desc')");
        $this->assertTrue($result);

        // Get the id of the last inserted task
        $result = mysqli_query($this->dbconfig, "SELECT id FROM todo ORDER BY id DESC LIMIT 1");
        $row = mysqli_fetch_assoc($result);
        $task_id = $row['id'];

        // Update the task
        $new_desc = 'Updated task';
        $result = mysqli_query($this->dbconfig, "UPDATE todo SET description='$new_desc' WHERE id=$task_id");
        $this->assertTrue($result);

        // Mark the task as completed
        $result = mysqli_query($this->dbconfig, "UPDATE todo SET status=1 WHERE id=$task_id");
        $this->assertTrue($result);

        // Delete the task
        $result = mysqli_query($this->dbconfig, "DELETE FROM todo WHERE id=$task_id");
        $this->assertTrue($result);
    }
}
?>
