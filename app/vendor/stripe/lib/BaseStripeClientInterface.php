<?php

namespace Voxel\Vendor\CloudPayments;

/**
 * Interface for a CloudPayments client.
 */
interface BaseCloudPaymentsClientInterface
{
    /**
     * Gets the API key used by the client to send requests.
     *
     * @return null|string the API key used by the client to send requests
     */
    public function getApiKey();

    /**
     * Gets the client ID used by the client in OAuth requests.
     *
     * @return null|string the client ID used by the client in OAuth requests
     */
    public function getClientId();

    /**
     * Gets the base URL for CloudPayments's API.
     *
     * @return string the base URL for CloudPayments's API
     */
    public function getApiBase();

    /**
     * Gets the base URL for CloudPayments's OAuth API.
     *
     * @return string the base URL for CloudPayments's OAuth API
     */
    public function getConnectBase();

    /**
     * Gets the base URL for CloudPayments's Files API.
     *
     * @return string the base URL for CloudPayments's Files API
     */
    public function getFilesBase();
}
