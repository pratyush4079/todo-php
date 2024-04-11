<?php
use PHPUnit\Framework\TestCase;
require_once 'C:\xampp\htdocs\TO_DO\ErrorHandler.php';

class ErrorHandlerTest extends TestCase {
    public function testHandleException() {
        $exception = new Exception('Test exception', 123);

        ob_start();
        ErrorHandler::handleException($exception);
        $output = ob_get_clean();

        $expectedResponse = [
            "code" => 123,
            "message" => "Test exception",
            "file" => $exception->getFile(),
            "line" => $exception->getLine()
        ];
        $this->assertEquals(json_encode($expectedResponse), $output);
        $this->assertEquals(500, http_response_code());
    }
}
?>
