<?php


namespace App\Helpers;


use Illuminate\Http\Response;

class ResponseHelper
{

    private static function _getErrorResponse(string $msg, array $data, int $statusCode = Response::HTTP_BAD_REQUEST): array
    {
        $response = [
            'status'  => 0,
            'code'    => $statusCode,
            'message' => $msg,
            'data'    => null,
            'errors'  => ((is_array($data) && count($data) == 0) ? null : $data),
        ];

        return $response;
    }

    private static function _getSuccessResponse(string $msg, array $data, int $statusCode = Response::HTTP_OK): array
    {
        $response = [
            'status'  => 1,
            'message' => $msg,
            'code'    => $statusCode,
            'data'    => ((is_array($data) && count($data) == 0) ? null : $data),
            'errors'  => null
        ];

        return $response;
    }


    // in case of any success requests of type >> ( get - put - delete )
    public static function getJsonSuccessResponse(array $data = [], $msg = ""): object
    {

        $statusCode = Response::HTTP_OK;

        $response = self::_getSuccessResponse($msg, $data, $statusCode);

        return response()->json($response, Response::HTTP_OK);

    }

    // in case of success creation requests of type >> ( post )
    public static function postJsonSuccessResponse(array $data = [], string $msg = ""): object
    {

        $statusCode = Response::HTTP_CREATED;

        $response = self::_getSuccessResponse($msg, $data, $statusCode);

        return response()->json($response, Response::HTTP_CREATED);

    }




    // in case of invalid payload (body - form-data) data or not exist
    public static function getJsonBadRequestErrorResponse(array $data = [], string $msg = ""): object
    {

        $statusCode = Response::HTTP_BAD_REQUEST;

        $response = self::_getErrorResponse($msg, $data, $statusCode);

        return response()->json($response, Response::HTTP_BAD_REQUEST);

    }


    // in case of not exist resource for end-point only >> ex. (/product/1)
    public function getJsonNotFoundErrorResponse(string $msg = "", array $data = []): object
    {

        $statusCode = Response::HTTP_NOT_FOUND;

        $response = $this->_getErrorResponse($msg, $data, $statusCode);

        return response()->json($response, Response::HTTP_OK);

    }

    // in case of error on validation for payload data for (body - form-data)
    public function getJsonValidationErrorResponse(string $msg = "", array $data = []): object
    {

        if (isset($data[0]) && isset($data[0]["errorMsg"])) {
            $msg = $data[0]["errorMsg"];
        }

        $statusCode = Response::HTTP_UNPROCESSABLE_ENTITY;

        $response = $this->_getErrorResponse($msg, $data, $statusCode);

        return response()->json($response, Response::HTTP_OK);

    }

    // in case of internal server error for (syntax - not handled error)
    public function getJsonInternalServerErrorResponse(string $msg = "", array $data = []): object
    {

        $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;

        $response = $this->_getErrorResponse($msg, $data, $statusCode);

        return response()->json($response, Response::HTTP_OK);

    }

    // bk: if basic membership try to do action for premium, it should redirect to buy membership first
    public function getJsonNotAllowedActionOnCurrentMembership(string $msg = "", array $data = []): object
    {

        $statusCode = 410;

        $response = $this->_getSuccessResponse($msg, $data, $statusCode);

        return response()->json($response, Response::HTTP_OK);

    }

    // bk: in case of user wallet not sufficient, it should redirect to increase his wallet
    public function getJsonUserNotEnoughBalanceErrorResponse(string $msg = "", array $data = []): object
    {

        $statusCode = 411;

        $response = $this->_getSuccessResponse($msg, $data, $statusCode);

        return response()->json($response, Response::HTTP_OK);

    }





}
