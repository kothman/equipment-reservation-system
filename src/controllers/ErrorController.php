<?php
/**
 * Default error controller
 */
namespace Kothman\ERS;

class ErrorController extends BaseController {

    public function __construct(protected string $statusCode = '404', protected string $errorMessage = 'Page not found') {

    }
    
    public function index() {
        return [
            'statusCode' => $this->statusCode,
            'errorMessage' => $this->errorMessage,
        ];
    }
}
