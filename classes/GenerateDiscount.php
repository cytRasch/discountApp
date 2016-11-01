<?php
/**
 * Created by PhpStorm.
 * User: akf-sebastianrasch
 * Date: 16.09.16
 * Time: 13:54
 */

namespace AGAN\Api;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../credentials/config.php';

use phpish\shopify;

class GenerateDiscount
{

    /**
     * @var string
     */
    public $callback = 'aganDiscount';

    public $currentDate = '';

    /**
     * @var int
     */
    public $length = 8;

    /**
     * @var \Closure
     */
    private $apiCall;

    /**
     * @var array
     */
    private $discount = [
        'discount_type' => 'fixed_amount',
        'value' => '6.00',
        'usage_limit' => 1,
        'status' => 'enabled',
        'minimum_order_amount' => '50.00',
    ];

    /**
     * @var string
     */
    protected $code = '';


    /**
     * GenerateDiscount constructor.
     */
    public function __construct()
    {
        // ISO8601 date format
        $this->currentDate = new \DateTime();
        $now = $this->currentDate->format(\DateTime::ATOM);

        // fill array
        $this->discount['starts_at'] = $now;
        $this->discount['code'] = $this->generateCode();

        // connect to api
        $shopify = $this->connectApi();

        // build & post discount object
        $response = $shopify('POST /admin/discounts.json', array(), array
        (
            'discount' => $this->discount
        ));

        // out jsonP object for
        // cross-browser access
        echo $this->createJsonp($response);

    }


    /**
     * @param $response
     * @return string
     */
    public function createJsonp ($response) {

        return $this->callback.'('.json_encode($response).');';

    }


    /**
     * @return mixed
     */
    public function getApiCall()
    {
        return $this->apiCall;
    }


    /**
     * @param mixed $apiCall
     */
    public function setApiCall($apiCall)
    {
        $this->apiCall = $apiCall;
    }


    /**
     * transform to string
     * to prevent __toString() errors
     * @return string
     */
    public function __toString()
    {
        return (string)$this->code;
    }


    /**
     * initial api connect
     * @return \Closure
     */
    private function connectApi ()
    {
        $this->apiCall = shopify\client(AGAN_URL, AGAN_APP_KEY, AGAN_APP_PASS, true);

        return $this->apiCall;
    }


    /**
     * generate code by pattern
     * fa-[a-zA-Z][0-9]{7}
     * @return string
     */
    private function generateCode () {
        $this->code = 'fa-' . substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($this->length / strlen($x)) )), 1, $this->length);

        return $this->code;
    }
}