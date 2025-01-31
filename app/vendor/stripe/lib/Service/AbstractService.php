<?php

namespace Voxel\Vendor\CloudPayments\Service;

/**
 * Abstract base class for all services.
 */
abstract class AbstractService
{
    /**
     * @var \Voxel\Vendor\CloudPayments\CloudPaymentsClientInterface
     */
    protected $client;

    /**
     * @var \Voxel\Vendor\CloudPayments\CloudPaymentsStreamingClientInterface
     */
    protected $streamingClient;

    /**
     * Initializes a new instance of the {@link AbstractService} class.
     *
     * @param \Voxel\Vendor\CloudPayments\CloudPaymentsClientInterface $client
     */
    public function __construct($client)
    {
        $this->client = $client;
        $this->streamingClient = $client;
    }

    /**
     * Gets the client used by this service to send requests.
     *
     * @return \Voxel\Vendor\CloudPayments\CloudPaymentsClientInterface
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Gets the client used by this service to send requests.
     *
     * @return \Voxel\Vendor\CloudPayments\CloudPaymentsStreamingClientInterface
     */
    public function getStreamingClient()
    {
        return $this->streamingClient;
    }

    /**
     * Translate null values to empty strings. For service methods,
     * we interpret null as a request to unset the field, which
     * corresponds to sending an empty string for the field to the
     * API.
     *
     * @param null|array $params
     */
    private static function formatParams($params)
    {
        if (null === $params) {
            return null;
        }
        \array_walk_recursive($params, function (&$value, $key) {
            if (null === $value) {
                $value = '';
            }
        });

        return $params;
    }

    protected function request($method, $path, $params, $opts)
    {
        return $this->getClient()->request($method, $path, self::formatParams($params), $opts);
    }

    protected function requestStream($method, $path, $readBodyChunkCallable, $params, $opts)
    {
        // TODO (MAJOR): Add this method to CloudPaymentsClientInterface
        // @phpstan-ignore-next-line
        return $this->getStreamingClient()->requestStream($method, $path, $readBodyChunkCallable, self::formatParams($params), $opts);
    }

    protected function requestCollection($method, $path, $params, $opts)
    {
        // TODO (MAJOR): Add this method to CloudPaymentsClientInterface
        // @phpstan-ignore-next-line
        return $this->getClient()->requestCollection($method, $path, self::formatParams($params), $opts);
    }

    protected function requestSearchResult($method, $path, $params, $opts)
    {
        // TODO (MAJOR): Add this method to CloudPaymentsClientInterface
        // @phpstan-ignore-next-line
        return $this->getClient()->requestSearchResult($method, $path, self::formatParams($params), $opts);
    }

    protected function buildPath($basePath, ...$ids)
    {
        foreach ($ids as $id) {
            if (null === $id || '' === \trim($id)) {
                $msg = 'The resource ID cannot be null or whitespace.';

                throw new \Voxel\Vendor\CloudPayments\Exception\InvalidArgumentException($msg);
            }
        }

        return \sprintf($basePath, ...\array_map('\urlencode', $ids));
    }
}
