<?php
namespace Ftob\LeaderBoardBundle\Repositories;

use Ftob\LeaderBoardBundle\Exceptions\HttpResponseException;
use Ftob\LeaderBoardBundle\Repositories\Http\HttpRepository;
use Psr\Http\Message\ResponseInterface;

/**
 * Class LeaderRepository
 * @package Ftob\LeaderBoardBundle\Repositories
 */
class LeaderRepository extends HttpRepository
{
    /**
     * @param ResponseInterface $responseInterface
     * @return mixed
     * @throws HttpResponseException
     * @throws \HttpInvalidParamException
     */
    protected function responseHandler(ResponseInterface $responseInterface)
    {
        // Проверяем код http, если не 200 или 201, то все нормально
        if ($this->checkHttpResponse($responseInterface)) {
            // Получаем тело запроса
            $body = json_decode($responseInterface->getBody());
            // Проверяем на json ошибки
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new HttpResponseException('Json invalid - ' . json_last_error_msg());
            }
            // Получем стус в ответе
            if ($status = object_get($body, 'status', null)) {
                if ($status === 'error') {
                    throw new HttpResponseException(
                        object_get($body, 'message', null),
                        object_get($body, 'code', 500)
                    );
                }
            }

            $parameter =  'leaderboard';

            if ($leaders = object_get($body, $parameter, null)) {
                return $leaders;
            } else {
                throw new \HttpInvalidParamException('Parameter - ' . $parameter);
            }
        }

        throw new HttpResponseException($responseInterface->getBody(), $responseInterface->getStatusCode());
    }

    /**
     * Check 200 and 201 http code
     * @param ResponseInterface $responseInterface
     * @return bool
     */
    private function checkHttpResponse(ResponseInterface $responseInterface)
    {
        return in_array($responseInterface->getStatusCode(), [200, 201])
        &&
        in_array('application/json', $responseInterface->getHeader('content-type'));
    }

    /**
     * @return string
     */
    public function getCacheKey()
    {
        return 'leader-board-cache';
    }

}