<?php
/*
 * Pipedrive
 *
 */

namespace Pipedrive\Controllers;

use Pipedrive\APIException;
use Pipedrive\APIHelper;
use Pipedrive\Configuration;
use Pipedrive\Models;
use Pipedrive\Exceptions;
use Pipedrive\Http\HttpRequest;
use Pipedrive\Http\HttpResponse;
use Pipedrive\Http\HttpMethod;
use Pipedrive\Http\HttpContext;
use Pipedrive\OAuthManager;
use Pipedrive\Servers;
use Pipedrive\Utils\CamelCaseHelper;
use Unirest\Request;

/**
 * @todo Add a general description for this controller.
 */
class CallLogsController extends BaseController
{
    /**
     * @var CallLogsController The reference to *Singleton* instance of this class
     */
    private static $instance;

    /**
     * Returns the *Singleton* instance of this class.
     * @return CallLogsController The *Singleton* instance.
     */
    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * Returns all call logs assigned to a particular user
     *
     * @param  array  $options    Array with all options for search
     * @param integer $options['limit']                 (optional) For pagination, the limit of entries to be returned
     * @param integer $options['start']                 (optional) For pagination, the position that represents the first result for the page
     * @return void response from the API call
     * @throws APIException Thrown if API call fails
     */
    public function getAllCallLogsAssignedToAParticularUser(
        $options
    ) {
        //check or get oauth token
        OAuthManager::getInstance()->checkAuthorization();

        //prepare query string for API call
        $_queryBuilder = '/callLogs';

        //process optional query parameters
        APIHelper::appendUrlWithQueryParameters($_queryBuilder, array (
            'start'                 => $this->val($options, 'start', 0),
            'limit'                 => $this->val($options, 'limit'),
        ));

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl(Configuration::getBaseUri() . $_queryBuilder);

        //prepare headers
        $_headers = array (
            'user-agent'          => BaseController::USER_AGENT,
            'Authorization' => sprintf('Bearer %1$s', Configuration::$oAuthToken->accessToken)
        );

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::GET, $_headers, $_queryUrl);
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
        }

        //and invoke the API call request to fetch the response
        $response = Request::get($_queryUrl, $_headers);

        $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
        $_httpContext = new HttpContext($_httpRequest, $_httpResponse);

        //call on-after Http callback
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
        }

        //handle errors defined at the API level
        $this->validateResponse($_httpResponse, $_httpContext);

        return CamelCaseHelper::keysToCamelCase($response->body);
    }

    /**
     * Returns details of a specific call log
     *
     * @param integer $id ID of the deal
     * @return mixed response from the API call
     * @throws APIException Thrown if API call fails
     */
    public function getDetailsOfACallLog(
        $id
    ) {
        //check or get oauth token
        OAuthManager::getInstance()->checkAuthorization();

        //prepare query string for API call
        $_queryBuilder = '/callLogs/{id}';

        //process optional query parameters
        $_queryBuilder = APIHelper::appendUrlWithTemplateParameters($_queryBuilder, array (
            'id' => $id,
            ));

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl(Configuration::getBaseUri() . $_queryBuilder);

        //prepare headers
        $_headers = array (
            'user-agent'    => BaseController::USER_AGENT,
            'Accept'        => 'application/json',
            'Authorization' => sprintf('Bearer %1$s', Configuration::$oAuthToken->accessToken)
        );

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::GET, $_headers, $_queryUrl);
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
        }

        //and invoke the API call request to fetch the response
        $response = Request::get($_queryUrl, $_headers);

        $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
        $_httpContext = new HttpContext($_httpRequest, $_httpResponse);

        //call on-after Http callback
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
        }

        //handle errors defined at the API level
        $this->validateResponse($_httpResponse, $_httpContext);

        $mapper = $this->getJsonMapper();

        return CamelCaseHelper::keysToCamelCase($response->body);
    }

    /**
     * Adds a new call log
     *
     * @param integer  $body['user_id']      (optional) The ID of the owner of the call log
     * @param integer  $body['activity_id']  (optional) If specified, this activity will be converted into a call log, with the information provided. When this field is used, you don't need to specify deal_id, person_id or org_id, as they will be ignored in favor of the values already available in the activity.
     * @param string   $body['subject']      (optional) Name of the activity this call is attached to
     * @param string   $body['duration']     (optional) Call duration in seconds
     * @param string   $body['outcome']      Describes the outcome of the call
     * @param string   $body['from_phone_number']    (optional) The number that made the call
     * @param string   $body['to_phone_number']      The number called
     * @param string   $body['start_time']   The date and time of the start of the call in UTC. Format: YYYY-MM-DD HH:MM:SS.
     * @param string   $body['end_time']     The date and time of the end of the call in UTC. Format: YYYY-MM-DD HH:MM:SS.
     * @param integer  $body['person_id']    (optional) The ID of the Person this call is associated with
     * @param integer  $body['org_id']       (optional) The ID of the Organization this call is associated with
     * @param integer  $body['deal_id']      (optional) The ID of the Deal this call is associated with
     * @param string   $body['note']         (optional) Note for the call log in HTML format
     * @return mixed response from the API call
     * @throws APIException Thrown if API call fails
     */
    public function addACallLog(
        $body
    ) {
        //check or get oauth token
        OAuthManager::getInstance()->checkAuthorization();

        //prepare query string for API call
        $_queryBuilder = '/callLogs';

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl(Configuration::getBaseUri() . $_queryBuilder);

        //prepare headers
        $_headers = array (
            'user-agent'    => BaseController::USER_AGENT,
            'Accept'        => 'application/json',
            'content-type'  => 'application/json; charset=utf-8',
            'Authorization' => sprintf('Bearer %1$s', Configuration::$oAuthToken->accessToken)
        );

        //json encode body
        $_bodyJson = Request\Body::Json($body);

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::POST, $_headers, $_queryUrl);
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
        }

        //and invoke the API call request to fetch the response
        $response = Request::post($_queryUrl, $_headers, $_bodyJson);

        $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
        $_httpContext = new HttpContext($_httpRequest, $_httpResponse);

        //call on-after Http callback
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
        }

        //handle errors defined at the API level
        $this->validateResponse($_httpResponse, $_httpContext);

        $mapper = $this->getJsonMapper();

        return CamelCaseHelper::keysToCamelCase($response->body);
    }

    /**
     * Adds an audio recording to the call log. That audio can be played
     * by those who have access to the call log object.
     *
     * @param integer $id The ID received when you create the call log
     * @param  array  $options    Array with all options for search
     * @param string  $options['file']        Audio file supported by the HTML5 specification
     * @param string  $options['mime_type']        The MIME type of the audio file supported by the HTML5 specification
     * @return void response from the API call
     * @throws APIException Thrown if API call fails
     */
    public function attachAnAudioFileToTheCallLog(
        $id,
        $options
    ) {
        //check or get oauth token
        OAuthManager::getInstance()->checkAuthorization();

        //prepare query string for API call
        $_queryBuilder = '/callLogs/{id}/recordings';

        //process path parameters
        $_queryBuilder = APIHelper::appendUrlWithTemplateParameters($_queryBuilder, array (
            'id' => $id,
            ));

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl(Configuration::getBaseUri() . $_queryBuilder);

        //prepare headers
        $_headers = array (
            'user-agent'    => BaseController::USER_AGENT,
            'Authorization' => sprintf('Bearer %1$s', Configuration::$oAuthToken->accessToken),
        );

        //prepare parameters
        $_parameters = array (
            'file'      => Request\Body::File($this->val($options, 'file'), $this->val($options, 'mime_type')),
        );

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::POST, $_headers, $_queryUrl, $_parameters);
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
        }

        //and invoke the API call request to fetch the response
        $response = Request::post($_queryUrl, $_headers, Request::buildHTTPCurlQuery($_parameters));

        $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
        $_httpContext = new HttpContext($_httpRequest, $_httpResponse);

        //call on-after Http callback
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
        }

        //handle errors defined at the API level
        $this->validateResponse($_httpResponse, $_httpContext);

        return CamelCaseHelper::keysToCamelCase($response->body);
    }


    /**
     * Deletes a call log. If there is an audio recording attached to it, 
     * it will also be deleted. The related activity will not be removed 
     * by this request. If you want to remove the related activities, 
     * please use the endpoint which is specific for activities.
     *
     * @param string $id ID of the callLog
     * @return mixed response from the API call
     * @throws APIException Thrown if API call fails
     */
    public function deleteACallLog(
        $id
    ) {
        //check or get oauth token
        OAuthManager::getInstance()->checkAuthorization();

        //prepare query string for API call
        $_queryBuilder = '/callLogs/{id}';

        //process optional query parameters
        $_queryBuilder = APIHelper::appendUrlWithTemplateParameters($_queryBuilder, array (
            'id' => $id,
            ));

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl(Configuration::getBaseUri() . $_queryBuilder);

        //prepare headers
        $_headers = array (
            'user-agent'    => BaseController::USER_AGENT,
            'Accept'        => 'application/json',
            'Authorization' => sprintf('Bearer %1$s', Configuration::$oAuthToken->accessToken)
        );

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::DELETE, $_headers, $_queryUrl);
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
        }

        //and invoke the API call request to fetch the response
        $response = Request::delete($_queryUrl, $_headers);

        $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
        $_httpContext = new HttpContext($_httpRequest, $_httpResponse);

        //call on-after Http callback
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
        }

        //handle errors defined at the API level
        $this->validateResponse($_httpResponse, $_httpContext);

        $mapper = $this->getJsonMapper();

        return CamelCaseHelper::keysToCamelCase($response->body);
    }

    /**
    * Array access utility method
     * @param  array          $arr         Array of values to read from
     * @param  string         $key         Key to get the value from the array
     * @param  mixed|null     $default     Default value to use if the key was not found
     * @return mixed
     */
    private function val($arr, $key, $default = null)
    {
        if (isset($arr[$key])) {
            return is_bool($arr[$key]) ? var_export($arr[$key], true) : $arr[$key];
        }
        return $default;
    }
}
