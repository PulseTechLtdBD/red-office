<?php

namespace App\Http\Controllers;

use Exception;

abstract class CRUDController
{
    protected $modelName;
    protected $paginate;
    protected $orderBy;
    protected $order;

    function __constructor()
    {
        $this->paginate = config('model.paginate.default');
        $this->orderBy  = config('model.order_by.default');
        $this->order    = config('model.order.default'); 
    }

    protected function sendResponseIndexSuccess(mixed $data)
    {
        $message = "{$this->modelName} list";

        return $this->sendResponse($data, $message, true, 200);
    }

    protected function sendResponseIndexFailed()
    {
        $message = "{$this->modelName} list not found";

        return $this->sendResponse($data, $message, false, 200);
    }

    protected function sendResponseShowSuccess(mixed $data)
    {
        
        $message = "{$this->modelName} exists";

        return $this->sendResponse($data, $message, true, 200);
    }

    protected function sendResponseShowFailed()
    {
        $message = "{$this->modelName} doesn't exist";

        return $this->sendResponse(null, $message, false, 200);
    }

    protected function sendResponseStoreOrUpdateSuccess(mixed $data = null, $create = true)
    {
        $message = $create ? "{$this->modelName} created successfully" : "{$this->modelName} updated successfully";

        return $this->sendResponse($data, $message, true, 200);
    }

    
    protected function sendResponseStoreOrUpdateFailed($create = true)
    {
        $message = $create ? "{$this->modelName} create failed" : "{$this->modelName} updated failed";

        return $this->sendResponse(null, $message, false, 200);
    }


    protected function sendResponseDeleteSuccess()
    {
        $message = "{$this->modelName} deleted successfully";
        return $this->sendResponse(null, $message, true, 200);
    }

    protected function sendResponseDeleteFailed()
    {
        $message = "Deleted failed";

        return $this->sendResponse(null, $message, false, 200);
    }

    protected function sendExceptionError(Exception $e)
    {
        return $this->sendResponse($e->getMessage(), "Failed", false, 500);
    }

    protected function sendResponse(mixed $result, string $message, bool $status = true, int $httpCode = 200)
    {
        return response()->json([
            'message' => $message,
            'result'  => $result,
            'success' => $status
        ], $httpCode);
    }
}

