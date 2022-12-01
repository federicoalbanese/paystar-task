
# Paystar - Task
## Run Locally

Clone the project

```bash
  git clone https://github.com/federicoalbanese/paystar-task
```

Go to the project directory

```bash
  cd paystar-task
```

Install dependencies

```bash
  composer install
  npm install
```

Start the server

```bash
  php artisan serv
  npm run dev
```


## Usage/Examples

#### Purchase/Pay
```php
$invoice = new App\Services\IPG\DTOs\Invoice();
$invoice->setAmount($amount);

$payStar = new \App\Services\PaystarIpgService();

$payStar
->invoice($invoice)
->purchase(function($refId){
    // use $refId to save in database.
})
->pay();
```
#### Verify Payment
```php
$gatewayResponse = new \App\Services\IPG\DTOs\GatewayResponse($request->all());

$invoiceDto = new InvoiceDto();
$invoiceDto->setAmount($amount);

$payStar = new \App\Services\PaystarIpgService();

$payStar
->invoice($invoice)
->verify($gatewayResponse);
```


## Authors






- [@federicoalbanese](https://github.com/federicoalbanese)

