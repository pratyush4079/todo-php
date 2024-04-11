<?php
use PHPUnit\Framework\TestCase;

require_once 'C:\xampp\htdocs\TO_DO\TodoImpl.php';
require_once 'C:\xampp\htdocs\TO_DO\Database.php';

class TodoImplTest extends TestCase {
    private $pdo;
    private $todoImpl;

    protected function setUp(): void {
        $this->pdo = $this->createMock(PDO::class);
        $database = $this->createMock(Database::class);
        $database->method('getConnection')->willReturn($this->pdo);
        $this->todoImpl = new TodoImpl($database);
    }

    public function testCreate() {
        $stmt = $this->createMock(PDOStatement::class);
        $this->pdo->expects($this->once())->method('prepare')->willReturn($stmt);
        $stmt->expects($this->once())->method('execute')->willReturn(true);
        $result = $this->todoImpl->create(['name' => 'Task', 'description' => 'Description']);
        $expectedResult["name"] = "Task";
        $expectedResult["description"] = "Description";
        $this->assertEquals($expectedResult,$result);
    }

    
    // public function testGetAll() {
    //     $stmt = $this->createMock(PDOStatement::class);
    //     $expected1["id"] =1;
    //     $expected1["name"] ="Task";
    //     $expectedResult = [$expected1];
    //     $stmt->method('fetchAll')->willReturn($expectedResult);
    //     $this->pdo->method('query')->willReturn($stmt);
    
    //     $result = $this->todoImpl->getAll();
    //     foreach ($result as $value) {
    //         echo $value["name"], "\n";
    //     }
    //     $this->assertEquals($expectedResult, $result);
    // }

    public function testGetById() {
        $stmt = $this->createMock(PDOStatement::class);
        $this->pdo->expects($this->once())->method('prepare')->willReturn($stmt);
        $stmt->expects($this->once())->method('execute');
        $stmt->expects($this->once())->method('fetch')->willReturn(['id' => 1, 'name' => 'Task', 'description' => 'Complete unit tests']);
        

        $result = $this->todoImpl->getById(1);
        $this->assertEquals(['id' => 1, 'name' => 'Task', 'description' => 'Complete unit tests'], $result);
    }

    public function testDelete() {
        $stmt = $this->createMock(PDOStatement::class);
        $stmt->expects($this->once())->method('execute')->willReturn(true);
        $this->pdo->expects($this->once())->method('prepare')->willReturn($stmt);

        $result = $this->todoImpl->delete(1);
        $this->assertTrue($result);
    }

    public function testUpdate() {
        $stmt = $this->createMock(PDOStatement::class);
        $stmt->expects($this->once())->method('execute')->willReturn(true);
        $this->pdo->expects($this->once())->method('prepare')->willReturn($stmt);
        $expected["name"]="Updated Task";
        $expected["description"]="Updated Description";

        $result = $this->todoImpl->update(1, ['name' => 'Updated Task', 'description' => 'Updated Description']);
        $this->assertEquals($expected,$result);
    }
}
?>
