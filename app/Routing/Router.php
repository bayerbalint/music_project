<?php

class Router{
    public function handle(){
        $method = strtoupper($_SERVER['REQUEST_METHOD']);
        $requestUri = $_SERVER['REQUEST_URI'];

        if ($method === 'post' && isset($_POST['_method'])){
            $method = strtoupper($_POST['_method']);
        }

        $this->dispatch($method, $requestUri);
    }

    private function dispatch($method, $requestUri){
        switch ($method){
            case 'GET':
                break;
            case 'POST':
                break;
            case 'PATCH':
                break;
            case 'DELETE':
                break;
        }
    }

    private function handleGetRequests($requestUri){
        switch ($requestUri){
            case '/songs':
                
                break;
            default:
                $this->notFound();
        }
    }

    private function handlePostRequests($requestUri){
        switch ($requestUri){
            default:
                $this->notFound();
        }
    }

    private function handlePatchRequests($requestUri){
        switch ($requestUri){
            default:
                $this->notFound();
        }
    }

    private function handleDeleteRequests($requestUri){
        switch ($requestUri){
            default:
                $this->notFound();
        }
    }
}