<?php
/**
 * MeetingsApi
 * PHP version 7.3
 *
 * @category Class
 * @package  Pipedrive\versions\v1
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Pipedrive API v1
 *
 * No description provided (generated by Openapi Generator https://github.com/openapitools/openapi-generator)
 *
 * The version of the OpenAPI document: 1.0.0
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 5.3.0
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Pipedrive\versions\v1\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Query;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Utils;
use InvalidArgumentException;
use Pipedrive\versions\v1\ApiException;
use Pipedrive\versions\v1\Configuration;
use Pipedrive\versions\v1\Exceptions\OAuthProviderException;
use Pipedrive\versions\v1\HeaderSelector;
use Pipedrive\versions\v1\ObjectSerializer;
use RuntimeException;

/**
 * MeetingsApi Class Doc Comment
 *
 * @category Class
 * @package  Pipedrive\versions\v1
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class MeetingsApi
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @var HeaderSelector
     */
    protected $headerSelector;

    /**
     * @var int Host index
     */
    protected $hostIndex;

    /**
     * @param ClientInterface|null $client
     * @param Configuration|null   $config
     * @param HeaderSelector|null  $selector
     * @param int                  $hostIndex (Optional) host index to select the list of hosts if defined in the OpenAPI spec
     */
    public function __construct(
        ClientInterface $client = null,
        Configuration $config = null,
        HeaderSelector $selector = null,
        int $hostIndex = 0
    ) {
        $this->client = $client ?: new Client();
        $this->config = $config ?: new Configuration();
        $this->headerSelector = $selector ?: new HeaderSelector();
        $this->hostIndex = $hostIndex;
    }

    /**
     * Set the host index
     *
     * @param int $hostIndex Host index (required)
     */
    public function setHostIndex(int $hostIndex): void
    {
        $this->hostIndex = $hostIndex;
    }

    /**
     * Get the host index
     *
     * @return int Host index
     */
    public function getHostIndex(): int
    {
        return $this->hostIndex;
    }

    /**
     * @return Configuration
     */
    public function getConfig(): Configuration
    {
        return $this->config;
    }

    /**
     * Operation deleteUserProviderLink
     *
     * Delete the link between a user and the installed video call integration
     *
     * @param  string $id Unique identifier linking a user to the installed integration (required)
     *
     * @throws ApiException on non-2xx response
     * @throws InvalidArgumentException|GuzzleException
     * @return \Pipedrive\versions\v1\Model\UserProviderLinkSuccessResponse|\Pipedrive\versions\v1\Model\UserProviderLinkErrorResponse|\Pipedrive\versions\v1\Model\UserProviderLinkErrorResponse
     */
    public function deleteUserProviderLink($id)
    {
        list($response) = $this->deleteUserProviderLinkWithHttpInfo($id);
        return $response;
    }

    /**
     * Operation deleteUserProviderLinkWithHttpInfo
     *
     * Delete the link between a user and the installed video call integration
     *
     * @param  string $id Unique identifier linking a user to the installed integration (required)
     *
     * @throws ApiException on non-2xx response
     * @throws InvalidArgumentException|GuzzleException
     * @return array<mixed> of \Pipedrive\versions\v1\Model\UserProviderLinkSuccessResponse|\Pipedrive\versions\v1\Model\UserProviderLinkErrorResponse|\Pipedrive\versions\v1\Model\UserProviderLinkErrorResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteUserProviderLinkWithHttpInfo($id)
    {
        $request = $this->deleteUserProviderLinkRequest($id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() === 401 && $this->config->isRefreshPossible()) {
                    $this->config->refreshToken();
                    $request = $this->deleteUserProviderLinkRequest($id);
                    $response = $this->client->send($request, $options);
                } else {
                    throw new ApiException(
                        "[{$e->getCode()}] {$e->getMessage()}",
                        (int) $e->getCode(),
                        $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                        $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                    );
                }
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();


            switch($statusCode) {
                case 200:
                    /* @phpstan-ignore-next-line */
                    if ('\Pipedrive\versions\v1\Model\UserProviderLinkSuccessResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Pipedrive\versions\v1\Model\UserProviderLinkSuccessResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 401:
                    /* @phpstan-ignore-next-line */
                    if ('\Pipedrive\versions\v1\Model\UserProviderLinkErrorResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Pipedrive\versions\v1\Model\UserProviderLinkErrorResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 403:
                    /* @phpstan-ignore-next-line */
                    if ('\Pipedrive\versions\v1\Model\UserProviderLinkErrorResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Pipedrive\versions\v1\Model\UserProviderLinkErrorResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            /* @phpstan-ignore-next-line */
            if ('\Pipedrive\versions\v1\Model\UserProviderLinkSuccessResponse' === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, '\Pipedrive\versions\v1\Model\UserProviderLinkSuccessResponse', []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Pipedrive\versions\v1\Model\UserProviderLinkSuccessResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Pipedrive\versions\v1\Model\UserProviderLinkErrorResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Pipedrive\versions\v1\Model\UserProviderLinkErrorResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation deleteUserProviderLinkAsync
     *
     * Delete the link between a user and the installed video call integration
     *
     * @param  string $id Unique identifier linking a user to the installed integration (required)
     *
     * @throws InvalidArgumentException|OAuthProviderException
     * @return PromiseInterface
     */
    public function deleteUserProviderLinkAsync($id): PromiseInterface
    {
        return $this->deleteUserProviderLinkAsyncWithHttpInfo($id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteUserProviderLinkAsyncWithHttpInfo
     *
     * Delete the link between a user and the installed video call integration
     *
     * @param  string $id Unique identifier linking a user to the installed integration (required)
     *
     * @throws InvalidArgumentException|OAuthProviderException
     * @return PromiseInterface
     */
    public function deleteUserProviderLinkAsyncWithHttpInfo($id): PromiseInterface
    {
        $returnType = '\Pipedrive\versions\v1\Model\UserProviderLinkSuccessResponse';
        $request = $this->deleteUserProviderLinkRequest($id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    /* @phpstan-ignore-next-line */
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'deleteUserProviderLink'
     *
     * @param  string $id Unique identifier linking a user to the installed integration (required)
     *
     * @throws InvalidArgumentException|OAuthProviderException
     * @return Request
     */
    public function deleteUserProviderLinkRequest($id): Request
    {
        // verify the required parameter 'id' is set
        /* @phpstan-ignore-next-line */
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling deleteUserProviderLink'
            );
        }

        $resourcePath = '/meetings/userProviderLinks/{id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{' . 'id' . '}',
                ObjectSerializer::toPathValue($id),
                $resourcePath
            );
        }


        /* @phpstan-ignore-next-line */
        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            /* @phpstan-ignore-next-line */
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = Utils::jsonEncode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = Query::build($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('x-api-token');
        if ($apiKey !== null) {
            $headers['x-api-token'] = $apiKey;
        }
        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            // If access token is expired
            if ($this->config->isRefreshPossible() && $this->config->getExpiresAt() <= time()) {
                $this->config->refreshToken();
            }
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = Query::build($queryParams);
        return new Request(
            'DELETE',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation saveUserProviderLink
     *
     * Link a user with the installed video call integration
     *
     * @param  \Pipedrive\versions\v1\Model\UserProviderLinkCreateRequest|null $user_provider_link_create_request user_provider_link_create_request (optional)
     *
     * @throws ApiException on non-2xx response
     * @throws InvalidArgumentException|GuzzleException
     * @return \Pipedrive\versions\v1\Model\UserProviderLinkSuccessResponse|\Pipedrive\versions\v1\Model\UserProviderLinkErrorResponse
     */
    public function saveUserProviderLink($user_provider_link_create_request = null)
    {
        list($response) = $this->saveUserProviderLinkWithHttpInfo($user_provider_link_create_request);
        return $response;
    }

    /**
     * Operation saveUserProviderLinkWithHttpInfo
     *
     * Link a user with the installed video call integration
     *
     * @param  \Pipedrive\versions\v1\Model\UserProviderLinkCreateRequest|null $user_provider_link_create_request (optional)
     *
     * @throws ApiException on non-2xx response
     * @throws InvalidArgumentException|GuzzleException
     * @return array<mixed> of \Pipedrive\versions\v1\Model\UserProviderLinkSuccessResponse|\Pipedrive\versions\v1\Model\UserProviderLinkErrorResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function saveUserProviderLinkWithHttpInfo($user_provider_link_create_request = null)
    {
        $request = $this->saveUserProviderLinkRequest($user_provider_link_create_request);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() === 401 && $this->config->isRefreshPossible()) {
                    $this->config->refreshToken();
                    $request = $this->saveUserProviderLinkRequest($user_provider_link_create_request);
                    $response = $this->client->send($request, $options);
                } else {
                    throw new ApiException(
                        "[{$e->getCode()}] {$e->getMessage()}",
                        (int) $e->getCode(),
                        $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                        $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                    );
                }
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();


            switch($statusCode) {
                case 200:
                    /* @phpstan-ignore-next-line */
                    if ('\Pipedrive\versions\v1\Model\UserProviderLinkSuccessResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Pipedrive\versions\v1\Model\UserProviderLinkSuccessResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 401:
                    /* @phpstan-ignore-next-line */
                    if ('\Pipedrive\versions\v1\Model\UserProviderLinkErrorResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Pipedrive\versions\v1\Model\UserProviderLinkErrorResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            /* @phpstan-ignore-next-line */
            if ('\Pipedrive\versions\v1\Model\UserProviderLinkSuccessResponse' === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, '\Pipedrive\versions\v1\Model\UserProviderLinkSuccessResponse', []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Pipedrive\versions\v1\Model\UserProviderLinkSuccessResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Pipedrive\versions\v1\Model\UserProviderLinkErrorResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation saveUserProviderLinkAsync
     *
     * Link a user with the installed video call integration
     *
     * @param  \Pipedrive\versions\v1\Model\UserProviderLinkCreateRequest|null $user_provider_link_create_request (optional)
     *
     * @throws InvalidArgumentException|OAuthProviderException
     * @return PromiseInterface
     */
    public function saveUserProviderLinkAsync($user_provider_link_create_request = null): PromiseInterface
    {
        return $this->saveUserProviderLinkAsyncWithHttpInfo($user_provider_link_create_request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation saveUserProviderLinkAsyncWithHttpInfo
     *
     * Link a user with the installed video call integration
     *
     * @param  \Pipedrive\versions\v1\Model\UserProviderLinkCreateRequest|null $user_provider_link_create_request (optional)
     *
     * @throws InvalidArgumentException|OAuthProviderException
     * @return PromiseInterface
     */
    public function saveUserProviderLinkAsyncWithHttpInfo($user_provider_link_create_request = null): PromiseInterface
    {
        $returnType = '\Pipedrive\versions\v1\Model\UserProviderLinkSuccessResponse';
        $request = $this->saveUserProviderLinkRequest($user_provider_link_create_request);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    /* @phpstan-ignore-next-line */
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'saveUserProviderLink'
     *
     * @param  \Pipedrive\versions\v1\Model\UserProviderLinkCreateRequest|null $user_provider_link_create_request (optional)
     *
     * @throws InvalidArgumentException|OAuthProviderException
     * @return Request
     */
    public function saveUserProviderLinkRequest($user_provider_link_create_request = null): Request
    {

        $resourcePath = '/meetings/userProviderLinks';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;





        /* @phpstan-ignore-next-line */
        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($user_provider_link_create_request)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($user_provider_link_create_request));
            } else {
                $httpBody = $user_provider_link_create_request;
            }
        } elseif (count($formParams) > 0) {
            /* @phpstan-ignore-next-line */
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = Utils::jsonEncode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = Query::build($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('x-api-token');
        if ($apiKey !== null) {
            $headers['x-api-token'] = $apiKey;
        }
        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            // If access token is expired
            if ($this->config->isRefreshPossible() && $this->config->getExpiresAt() <= time()) {
                $this->config->refreshToken();
            }
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Create http client option
     *
     * @throws RuntimeException on file opening failure
     * @return array<string, resource> of http client options
     */
    protected function createHttpClientOption(): array
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->config->getDebugFile(), 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new RuntimeException('Failed to open the debug file: ' . $this->config->getDebugFile());
            }
        }

        return $options;
    }
}
