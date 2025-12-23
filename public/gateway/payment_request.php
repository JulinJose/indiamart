<!-- <?php
// gateway/payment_request.php

function generatePaynimoRequest(array $input)
{
    $configPath = __DIR__ . '/worldline_AdminData.json';

    if (!file_exists($configPath)) {
        throw new Exception("Worldline config file missing");
    }

    $config = json_decode(file_get_contents($configPath), true);
    if (!$config) {
        throw new Exception("Invalid Worldline config JSON");
    }

    // Required fields
    $data = array_merge([
        "mrctCode" => $config['merchantCode'],
        "txn_id" => "",
        "amount" => 0,
        "accNo" => "",
        "custID" => "",
        "mobNo" => "",
        "email" => "",
        "debitStartDate" => "",
        "debitEndDate" => "",
        "maxAmount" => "",
        "amountType" => "",
        "frequency" => "",
        "cardNumber" => "",
        "expMonth" => "",
        "expYear" => "",
        "cvvCode" => "",
        "returnUrl" => "",
        "name" => "",
        "scheme" => "",
        "currency" => $config['currency'] ?? 'INR',
        "accountName" => "",
        "ifscCode" => "",
        "accountType" => "",
        "SALT" => $config['salt']
    ], $input);

    // TEST MODE
    if ($config['typeOfPayment'] === 'TEST') {
        $data['amount'] = 1;
    }

    $hashString = implode("|", [
        $data['mrctCode'],
        $data['txn_id'],
        $data['amount'],
        $data['accNo'],
        $data['custID'],
        $data['mobNo'],
        $data['email'],
        $data['debitStartDate'],
        $data['debitEndDate'],
        $data['maxAmount'],
        $data['amountType'],
        $data['frequency'],
        $data['cardNumber'],
        $data['expMonth'],
        $data['expYear'],
        $data['cvvCode'],
        $data['SALT']
    ]);

    $hash = hash('sha512', $hashString);

    return [
        "hash" => $hash,
        "data" => [
            $data['mrctCode'],
            $data['txn_id'],
            $data['amount'],
            $data['debitStartDate'],
            $data['debitEndDate'],
            $data['maxAmount'],
            $data['amountType'],
            $data['frequency'],
            $data['custID'],
            $data['mobNo'],
            $data['email'],
            $data['accNo'],
            $data['returnUrl'],
            $data['name'],
            $data['scheme'],
            $data['currency'],
            $data['accountName'],
            $data['ifscCode'],
            $data['accountType']
        ]
    ];
}
