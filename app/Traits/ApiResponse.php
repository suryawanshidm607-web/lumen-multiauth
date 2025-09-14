<?php

namespace App\Traits;
use Illuminate\Http\Response;

trait ApiResponse
{
   /**
     * Build success response
     *
     * @param mixed $data
     * @param string|null $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
     public function successResponse($data,$code = Response::HTTP_OK)
    {   
       
        $defaultMessages = [
            Response::HTTP_OK => 'Request was successful',
            Response::HTTP_CREATED => 'Resource created successfully',
            Response::HTTP_ACCEPTED => 'Request accepted',
            Response::HTTP_NO_CONTENT => 'Resource deleted successfully'
        ];
        
        
        $message = $defaultMessages[$code] ?? 'Request successful';

        $response = [
            'status' => $code,
            'message' => $message,
            'data' => $data
        ];
        return response()->json($response, $code);
    }

    /**
     * Build error response
     *
     * @param string|array $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorResponse($message,$code)
    {
        
       return response()->json([
            'status' => $code,
            'error'  => $message,
        ], $code);
    }
}
