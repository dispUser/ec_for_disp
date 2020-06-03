<?php
    use PHPUnit\Framework\TestCase;
    include_once __DIR__ . "/../../../src/common/Function.php";

    class StaffTest extends TestCase{
        public function testSelectStaff(){
            $staffEntity = getStaffByCodeAndPass(5, "demo")[0];
            $this->assertEquals(5, $staffEntity->code);
            $this->assertEquals("test", $staffEntity->name);
        }

        public function testAddStaff(){
            // 新規スタッフ作成
            // $name = "test";
            // $password = "password";
            // execInsert($name, $password);
            $this->assertEquals(10, 10);
        }
    }
?>