# DistriMedia PHP Client

## NOTICE
IF YOU WISH TO MAKE USE OF THIS PACKAGE , PLEASE ALWAYS CONTACT DISTRIMEDIA IN ADVANCE PLEASE

## Introduction 
This module provides PHP Services for the following SOAP calls:

### CreateOrder
1. Create an Order Service Object `DistriMedia\SoapClient\Service\Order`
2. Call the function `createOrder` with the following parameters
    1. Order (`DistriMedia\SoapClient\Struct\Order`)
    
### Request Order Status
1. Create an Order Service Object `DistriMedia\SoapClient\Service\Order`
2. Call the function `changeOrderStatusby{$param}` with the following parameters
    1. OrderID (string) | OrderNumber (string) | OrderReference
    2. Status (`Startorder`, `Cancel`)

    
### Change Order Status
1. Create an Order Service Object `DistriMedia\SoapClient\Service\Order`
2. Call the function `changeOrderStatus{$param}` with the following parameters
    1. OrderID (string) | OrderNumber (string) | OrderReference
    2. Status (`Startorder`, `Cancel`)

### Change Customer
1. Create a Customer Service Object `DistriMedia\SoapClient\Service\Customer`
2. Call the function `changeCustomer{$param}` with the following parameters
    1. Customer (`DistriMedia\SoapClient\Struct\Customer`)
    2. OrderID (string)

### RequestInventory
1. Create an Inventory Service Object `DistriMedia\SoapClient\Service\Inventory`
2. Call the function `changeOrderStatus{$param}` with the following parameters
    1. OrderID (string) | OrderNumber (string) | OrderReference
    2. Status (`Startorder`, `Cancel`)
    
## Authors
 - Baldwin bv <info@baldwin.be>
 
## Testing
1. copy `.env.dist` to `.env` and fill in your credentials. 

2. Execute `docker-compose run phpunit` to run the unit tests
