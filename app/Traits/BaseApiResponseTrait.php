<?php

namespace App\Traits;

use App\Enums\ResponseEnum;
use App\Http\Resources\PaginationResource;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

trait BaseApiResponseTrait
{
    protected ?int $statusCode = NULL;

    /**
     * setStatusCode() set status code value
     *
     * @param $statusCode
     * @return $this
     */
    protected function setStatusCode($statusCode): static
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * respondWithArray() used to return json response array with status and headers
     *
     * @param $data
     * @param array $headers
     * @return JsonResponse
     */
    protected function respondWithArray($data, array $headers = []): JsonResponse
    {
        return response()->json($data, $data['status'], $headers);
    }

    /**
     * getStatusCode() return status code value
     *
     * @return int
     */
    protected function getStatusCode(): int
    {
        return $this->statusCode ?: ResponseEnum::RESPONSE_STATUS_OK;
    }
    /**
     * respondWithSuccess() used to return success message
     *
     * @param string|null $message
     * @param array $data
     * @return JsonResponse
     */
    protected function respondWithSuccess(string $message = null, array $data = []): JsonResponse
    {
        $response = [
            'status' => ResponseEnum::RESPONSE_STATUS_OK,
        ];
        $response['message'] = !empty($message) ? $message : __('Success');
        if (!empty($data)) {
            $response['data'] = $data;
        }
        return $this->setStatusCode(ResponseEnum::RESPONSE_STATUS_OK)->respondWithArray($response);
    }
    protected function respondWithSuccessPaginated( $message ,  $data ): JsonResponse
    {

        dd($data);
        return $data;
        return response()->json([
            'status' => ResponseEnum::RESPONSE_STATUS_OK,
            'message' => $message,
            'data' => $data
        ]);
    }

    /**
     * respondWithError() used to return error message
     *
     * @param $message
     * @return JsonResponse
     */
    protected function respondWithError($message): JsonResponse
    {
        if ($this->statusCode === 200) {
            trigger_error(
                "You better have a really good reason for error on a 200...",
                E_USER_WARNING
            );
        }
        return $this->respondWithErrors($message, $this->statusCode,[],$message);
    }

    /**
     * respondWithErrors()
     *
     * @param string $errors
     * @param null $statusCode
     * @param array $data
     * @param null $message
     * @return JsonResponse
     */
    protected function respondWithErrors(
        string $errors = 'messages.error',
               $statusCode = null,
        array  $data = [],
               $message = null
    ): JsonResponse
    {
        $statusCode = !empty($statusCode) ? $statusCode : ResponseEnum::RESPONSE_STATUS_ERROR;
        if (is_string($errors)) {
            $errors = __($errors);
        }
        $response = ['status' => $statusCode, 'message' => $message, 'errors' => ['message' => [$errors]]];
        if (!empty($message)) {
            $response['message'] = $message;
        }
        if (!empty($data)) {
            $response['data'] = $data;
        }
        return $this->setStatusCode($statusCode)->respondWithArray($response);
    }

    /**
     * respondWithBoolean() used to determine if process success or failed
     *
     * @param $result
     * @return JsonResponse
     */
    protected function respondWithBoolean($result): JsonResponse
    {
        return $result ? $this->respondWithSuccess() : $this->errorUnknown();
    }

    /**
     * **************************************************************************
     *                           Response Status Helpers
     * **************************************************************************
     */

    /**
     * errorWrongArgs() Generates a Response with a 400 HTTP header and a given message.
     *
     * @param null $message
     * @return JsonResponse
     */
    public function errorWrongArgs($message = null): JsonResponse
    {
        if (empty($message)) {
            $message = __('Wrong Arguments');
        }
        return $this->setStatusCode(400)->respondWithError($message);
    }

    /**
     * errorUnauthorized() Generates a Response with a 401 HTTP header and a given message.
     *
     * @param null $message
     * @return JsonResponse
     */
    public function errorUnauthorized($message = null): JsonResponse
    {
        if (empty($message)) {
            $message = __('Unauthorized');
        }
        return $this->respondWithErrors($message, 401);
    }

    /**
     * errorForbidden() Generates a Response with a 403 HTTP header and a given message.
     *
     * @param null $message
     * @return JsonResponse
     */
    public function errorForbidden($message = null): JsonResponse
    {
        if (empty($message)) {
            $message = __('Forbidden');
        }
        return $this->setStatusCode(403)->respondWithError($message);
    }

    /**
     * errorNotFound() Generates a Response with a 404 HTTP header and a given message.
     *
     * @param null $message
     * @return JsonResponse
     */
    public function errorNotFound($message = null): JsonResponse
    {
        if (empty($message)) {
            $message = __('Not Found');
        }
        return $this->setStatusCode(404)->respondWithError($message);
    }

    /**
     * errorInternalError() Generates a Response with a 500 HTTP header and a given message.
     *
     * @param null $message
     * @return JsonResponse
     */
    public function errorInternalError($message = null): JsonResponse
    {
        if (empty($message)) {
            $message = __('Internal Server Error');
        }
        return $this->setStatusCode(500)->respondWithError($message);
    }

    /**
     * errorUnknown() Generates a Response with a 500 HTTP header and a given message.
     *
     * @param string $message
     * @return JsonResponse
     */
    public function errorUnknown(string $message = 'dashboard.unknown_error'): JsonResponse
    {
        if (empty($message)) {
            $message = __('Unknown Error');
        }
        return $this->setStatusCode(500)->respondWithError($message);
    }

    /**
     * base json response
     *
     * @param $data
     * @param int $statusCode
     * @return JsonResponse
     */
    public function respondWithJson($data, int $statusCode = 200): JsonResponse
    {
        return response()->json($data, $statusCode);
    }

    /**
     * validation errors stamp for dynamics
     *
     * @param $request
     * @return array
     */
    public function dynamicsTokenCheck($request): array
    {
        if ($request->_token != config('dynamics.token')) {
            $data['status'] = 0;
            $data['errors']['_token'] = 'Invalid Token';
            return [
                'data' => $data,
                'statusCode' => 401
            ];
        }
        return [];
    }

    /**
     * validation errors stamp for dynamics
     *
     * @param $request
     * @param array $rules
     * @return array
     */
    public function dynamicsValidationErrors($request, array $rules): array
    {
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errors = [];
            $errors_str = "";
            foreach ($validator->errors()->toArray() as $key => $error) {
                $errors[$key] = $error[0];
                $errors_str = $errors_str . $error[0] . "\n";
            }
            $data['status'] = 0;
            $data['errors'] = $errors;
            return [
                'data' => $data,
                'statusCode' => 422
            ];
        }
        return [];
    }

    public function respondWithData($data,$paginate=false,$status=200,$extra=[])
    {

        $responseArray = [
            'status' => $status,
            'message' => __('web.messages.data_show_successfully'),
            'data' =>$data,
        ];

        if ( $extra ){
            foreach ($extra as $key => $value){
                $responseArray[$key] = $value;
            }
        }

        if ( $paginate ) {
            $responseArray['meta'] = new PaginationResource($data);
        }



        return response()->json($responseArray,$status);
    }


}
