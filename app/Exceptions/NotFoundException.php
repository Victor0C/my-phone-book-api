<?php

namespace App\Exceptions;

use Exception;

class NotFoundException extends Exception
{
    public function render()
    {
        return response()->json([
            'error' => 'No Found: ' . $this->getMessage()
        ], 404); 
    }
}
