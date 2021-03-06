<?php
/**
 * Created by PhpStorm.
 * User: pawel
 * Date: 21.08.18
 * Time: 15:47
 */

namespace Bliskapaczka\Prestashop\Core\Query;

/**
 * Class RestWaybillQuery
 *
 * @package Bliskapaczka\Prestashop\Core\Query
 */
class RestWaybillQuery implements WaybillQueryInterface
{
    /**
 * @var \Bliskapaczka\ApiClient\Bliskapaczka\Order
*/
    protected $apiClient;

    /**
     * RestWaybillQuery constructor.
     *
     * @param \Bliskapaczka\ApiClient\Bliskapaczka\Order\Waybill $apiClient
     */
    public function __construct(\Bliskapaczka\ApiClient\Bliskapaczka\Order\Waybill $apiClient)
    {
        $this->apiClient = $apiClient;
    }


    /**
     * @inheritdoc
     * @param int $orderId
     * @throws \Exception
     */
    public function getByOrderId($orderId)
    {
        $this->apiClient->setOrderId($orderId);
        $response = $this->apiClient->get();

        $decodedResponse = json_decode($response);
        $decodedResponse = $decodedResponse[0];

        return new WaybillView($decodedResponse->url);
    }
}
