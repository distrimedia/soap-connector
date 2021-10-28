<?php
/**
 *
 *
 *  IF YOU WISH TO MAKE USE OF THIS PACKAGE , PLEASE ALWAYS CONTACT DISTRIMEDIA IN ADVANCE PLEASE
 *
 *  This source file is subject to the Open Software License (OSL 3.0)
 *  that is provided with Magento in the file LICENSE.txt.
 *  It is also available through the world-wide-web at this URL:
 *  http://opensource.org/licenses/osl-3.0.php
 *
 *  DISCLAIMER
 *
 *  Do not edit or add to this file if you wish to upgrade the DistriMediaClient plugin
 *  to newer versions in the future. If you wish to customize the plugin for your
 *  needs please document your changes and make backups before your update.
 *
 *  @category  Baldwin
 *  @package  DistriMediaClient
 *  @author      Baldwin bv <info@baldwin.be>
 *  @copyright Copyright (c) 2020 Baldwin BV (https://www.baldwin.be)
 *  @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 *
 *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED,
 *  INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR
 *  PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
 *  HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN
 *  ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 *  WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 */

declare(strict_types=1);

namespace DistriMedia\SoapClient\Service;

use DistriMedia\SoapClient\InvalidOrderException;

class Order extends AbstractSoapClient
{
    const CREATE_ORDER_ACTION = 'CreateOrder';
    const REQUEST_ORDER_STATUS = 'RequestOrderStatus';
    const CHANGE_ORDER_STATUS = 'ChangeOrderStatus';
    const ORDER_STATUS_START_ORDER = 'Startorder';
    const ORDER_STATUS_CANCEL = 'Cancel';
    const ORDER_STATUS = 'Status';
    const ORDER_NUMBER = 'OrderNumber';
    const ORDER_REFERENCE = 'OrderReference';
    const ORDER_ID = 'OrderID';

    const VALID_ACTION_NAMES = [
        self::CREATE_ORDER_ACTION,
        self::REQUEST_ORDER_STATUS,
        self::CHANGE_ORDER_STATUS
    ];

    /**
     * Request order status by Order ID (no leading zeroes required)
     * @param \DistriMedia\SoapClient\Struct\Order $order
     * @return \DistriMedia\SoapClient\Struct\Response\Order
     * @throws InvalidOrderException
     */
    public function createOrder(\DistriMedia\SoapClient\Struct\Order $order)
    {
        $order->validate();
        $data = $order->__toArray();

        return $this->_execute(
            $data,
            self::CREATE_ORDER_ACTION,
            \DistriMedia\SoapClient\Struct\Order::ORDER,
        );
    }

    /**
     * Request order status by Order ID (no leading zeroes required)
     * @param string $orderNumber
     * @return \DistriMedia\SoapClient\Struct\Response\Order
     * @throws InvalidOrderException
     */
    public function requestOrderStatusByOrderId(string $orderID)
    {
        $data  = [
            self::ORDER_ID => $orderID
        ];

        return $this->_execute($data, self::REQUEST_ORDER_STATUS, self::CHANGE_ORDER_STATUS);
    }

    /**
     * Request order status by Order ID (no leading zeroes required)
     * @param string $orderNumber
     * @return \DistriMedia\SoapClient\Struct\Response\Order
     * @throws InvalidOrderException
     */
    public function requestOrderStatusByOrderReference(string $orderReference)
    {
        $data  = [
            self::ORDER_REFERENCE => $orderReference
        ];

        return $this->_execute($data, self::REQUEST_ORDER_STATUS, self::CHANGE_ORDER_STATUS);
    }

    /**
     * Request order status by Order ID (no leading zeroes required)
     * @param string $orderNumber
     * @return \DistriMedia\SoapClient\Struct\Response\Order
     * @throws InvalidOrderException
     */
    public function requestOrderStatusByOrderNumber(string $orderNumber)
    {
        $data  = [
            self::ORDER_NUMBER => $orderNumber
        ];

        return $this->_execute($data, self::REQUEST_ORDER_STATUS, self::CHANGE_ORDER_STATUS);
    }



    /**
     * Change order status by Order ID (no leading zeroes required)
     * @param string $referenceId
     * @param string $status
     * @return \DistriMedia\SoapClient\Struct\Response\Order
     * @throws InvalidOrderException
     */
    public function changeOrderStatusByOrderId(string $orderID, string $status)
    {
        $data = [
            self::ORDER_NUMBER => $orderID,
            self::ORDER_STATUS => $status
        ];

        return $this->_execute(
            $data,
            self::CHANGE_ORDER_STATUS, self::CHANGE_ORDER_STATUS);
    }

    /**
     * Change order status by Reference (no leading zeroes required)
     * @param string $referenceId
     * @param string $status
     * @return \DistriMedia\SoapClient\Struct\Response\Order
     * @throws InvalidOrderException
     */
    public function changeOrderStatusByReferenceId(string $referenceId, string $status)
    {
        $data = [
            self::ORDER_REFERENCE => $referenceId,
            self::ORDER_STATUS => $status
        ];

        return $this->_execute(
            $data,
            self::CHANGE_ORDER_STATUS, self::CHANGE_ORDER_STATUS);
    }

    /**
     * Change order status by Order Number (no leading zeroes required)
     * @param string $orderNumber
     * @param string $status
     * @return \DistriMedia\SoapClient\Struct\Response\Order
     * @throws InvalidOrderException
     */
    public function changeOrderStatusByOrderNumber(string $orderNumber, string $status)
    {
        $data = [
            self::ORDER_NUMBER => $orderNumber,
            self::ORDER_STATUS => $status
        ];

        return $this->_execute(
            $data,
            self::CHANGE_ORDER_STATUS, self::CHANGE_ORDER_STATUS);
    }


    private function _execute(array $data, string $action, string $rootElement = '')
    {
        $result = $this->execute(
            $data,
            $action,
            $rootElement
        );

        $orderResponse = new \DistriMedia\SoapClient\Struct\Response\Order($result);

        if ($orderResponse->getStatus() === self::STATUS_ERROR) {
            throw new InvalidOrderException($orderResponse->getReason());
        }

        return $orderResponse;
    }
}
