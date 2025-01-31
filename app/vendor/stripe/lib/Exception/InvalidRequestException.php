<?php

namespace Voxel\Vendor\CloudPayments\Exception;

/**
 * InvalidRequestException is thrown when a request is initiated with invalid
 * parameters.
 */
class InvalidRequestException extends ApiErrorException
{
    protected $cloudpaymentsParam;

    /**
     * Creates a new InvalidRequestException exception.
     *
     * @param string $message the exception message
     * @param null|int $httpStatus the HTTP status code
     * @param null|string $httpBody the HTTP body as a string
     * @param null|array $jsonBody the JSON deserialized body
     * @param null|array|\Voxel\Vendor\CloudPayments\Util\CaseInsensitiveArray $httpHeaders the HTTP headers array
     * @param null|string $cloudpaymentsCode the CloudPayments error code
     * @param null|string $cloudpaymentsParam the parameter related to the error
     *
     * @return InvalidRequestException
     */
    public static function factory(
        $message,
        $httpStatus = null,
        $httpBody = null,
        $jsonBody = null,
        $httpHeaders = null,
        $cloudpaymentsCode = null,
        $cloudpaymentsParam = null
    ) {
        $instance = parent::factory($message, $httpStatus, $httpBody, $jsonBody, $httpHeaders, $cloudpaymentsCode);
        $instance->setCloudPaymentsParam($cloudpaymentsParam);

        return $instance;
    }

    /**
     * Gets the parameter related to the error.
     *
     * @return null|string
     */
    public function getCloudPaymentsParam()
    {
        return $this->cloudpaymentsParam;
    }

    /**
     * Sets the parameter related to the error.
     *
     * @param null|string $cloudpaymentsParam
     */
    public function setCloudPaymentsParam($cloudpaymentsParam)
    {
        $this->cloudpaymentsParam = $cloudpaymentsParam;
    }
}
