# INTEGRATION API CINETPAY

## Auteurs

  - [@Barkalab](https://www.barkalab.com/) entreprise 
  - [@Prospersedgo](https://github.com/Prosper226/) développeur
  - [@CinetPay](https://cinetpay.com/) Integrateur


## Notes:
    En production, 
        -   Le fichier de configurations est renommé en .config.json
        -   Plusieurs business peuvent être configurés. Il suffit de dupliqué
            l'ensemble de la collection contenu du premier business et renseigner les champs
            clés de configuration pour le nouveau business.

    Le dossier "resources", contient fidelement les codes sources sdk-php de cinetPay.
    Les fichiers Guichet.php et PayService.php sont juste des repliques des ressources sdk-php
    fournit par cinetPay, avec quelques petites modifications.


## Tests:
Création et instanciation:
```php
<?php
    use CinetPay\Cinet;
    require(__DIR__.'/vendor/autoload.php');
    try{

        $Cinet = new Cinet("MONBUSINESS");
        
        // Suites sources.

    }catch(Exception $e){
        echo "Error: " . $e->getMessage();
    }
?>
```

Depot:
```php
    try{
        //  1- Instanciation de l'objet Cinet
        /** 2- Sample deposit */
        $deposit = $Cinet->deposit("BFA",["phone" => 57474578, "amount" => 1500, "bash" => "D01u34"]);
        $deposit = (array)$deposit;
        print_r($deposit);

        //  3- Resultat:
        // Array
        // (
        //     [code] => 200
        //     [data] => Array
        //         (
        //             [transaction_id] => D01u34
        //             [amount] => 1500
        //             [customer_phone_number] => +22657474578
        //             [payment_url] => https://checkout.cinetpay.com/payment/3c6ecfd2c6f0xxxx228ca089810d68022381dde5xxxxxx55f305e037a90301aea1dfd2983857f9xxxxxx04e567efa5aaed9xxxxx
        //         )
        //     [payment_url] => https://checkout.cinetpay.com/payment/3c6ecfd2c6f0xxxx228ca089810d68022381dde5xxxxxx55f305e037a90301aea1dfd2983857f9xxxxxx04e567efa5aaed9xxxxx
        // )
    }catch(Exception $e){
        echo "Error: " . $e->getMessage();
    }
```

Retrait: En cours...
```php
    try{
        //  1- Instanciation de l'objet Cinet
        /** 2- Sample retrait */
        $withdraw = $Cinet->withdraw("BFA", ["phone" => 57474578, "amount" => 500, "bash" => "Wi094k"]);
        $withdraw = (array)$withdraw;
        print_r($withdraw);
        //  3- Resultat: Aucun result conncluant pour l'instant.

    }catch(Exception $e){
        echo "Error: " . $e->getMessage();
    }
```

Solde Cas 1: 
```php
    try{
        //  1- Instanciation de l'objet Cinet
        /** 2- Sample check balance */
        $balance = $Cinet->balance('CI');
        $balance = (array)$balance;
        print_r($balance);

        // 3- Resultat
        // Array
        // (
        //     [code] => 200
        //     [balance] => 0
        // )
    }catch(Exception $e){
        echo "Error: " . $e->getMessage();
    }
```

Solde Cas 2:
```php
    try{
        //  1- Instanciation de l'objet Cinet
        /** 2- Sample check balance all */
        $balance = $Cinet->balance();
        $balance = (array)$balance;
        print_r($balance);

        // 3- Resultat
        // Array
        // (
        //     [code] => 200
        //     [balance] => Array
        //         (
        //             [CI] => Array
        //                 (
        //                     [available] => 0
        //                 )
        //             [SN] => Array
        //                 (
        //                     [available] => 0
        //                 )
        //             [CM] => Array
        //                 (
        //                     [available] => 0
        //                 )
        //             [ML] => Array
        //                 (
        //                     [available] => 0
        //                 )
        //         )
        // )
    }catch(Exception $e){
        echo "Error: " . $e->getMessage();
    }
```

Notification:
```php
    try{
        //  1- Instanciation de l'objet Cinet
        /** 2- Sample check notify status */
        $data = $_POST; // ou $data =  json_decode(file_get_contents("php://input"));
        $status = $Cinet->operationStatus($data);
        error_log(json_encode($status));
        /** 
         * status renvoi la fidelite de $data si les informations qui ont sont 
         * contenu sont correct en passant par le HMAC et si la transaction est un 
         * succes. Sinon il renvoi un false.
         */ 
        // 3- Resultat
        /**
         * {
         * "cpm_site_id":"xxxxx",
         * "cpm_trans_id":"D01u35",
         * "cpm_trans_date":"2022-09-29 14:13:16",
         * "cpm_amount":"100",
         * "cpm_currency":"XOF"
         * "signature":"xxxxxxxxxxxxxxxxxxxxxx",
         * "payment_method":"OMBF",
         * "cel_phone_num":"57474578",
         * "cpm_phone_prefixe":"226",
         * "cpm_language":"fr",
         * "cpm_version":"V4",
         * "cpm_payment_config":"SINGLE",
         * "cpm_page_action":"PAYMENT",
         * "cpm_designation":"Paiement mobile vers MONBUSINESS"
         * }
         */
    }catch(Exception $e){
        error_log($e->getMessage());
    }
```
