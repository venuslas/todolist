<?php
use PHPUnit\Framework\TestCase;

class ProcessAcceptanceTest extends TestCase
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

        // Check the updated task
        $result = mysqli_query($this->dbconfig, "SELECT description FROM todo WHERE id=$task_id");
        $row = mysqli_fetch_assoc($result);
        $this->assertEquals($new_desc, $row['description']);

        // Mark the task as completed
        $result = mysqli_query($this->dbconfig, "UPDATE todo SET status=1 WHERE id=$task_id");
        $this->assertTrue($result);

        // Check the status of the task
        $result = mysqli_query($this->dbconfig, "SELECT status FROM todo WHERE id=$task_id");
        $row = mysqli_fetch_assoc($result);
        $this->assertEquals(1, $row['status']);

        // Delete the task
        $result = mysqli_query($this->dbconfig, "DELETE FROM todo WHERE id=$task_id");
        $this->assertTrue($result);

        // Check if the task is deleted
        $result = mysqli_query($this->dbconfig, "SELECT * FROM todo WHERE id=$task_id");
        $this->assertEquals(0, mysqli_num_rows($result));
    }
}
?>