<?php
    header('Content-Type: application/json; charset=utf-8');
    use CinetPay\Cinet;
    require(__DIR__.'/vendor/autoload.php');

    try{
        $Cinet = new Cinet("BARKACHANGE");
        
        /** Sample depot */
        // $deposit = $Cinet->deposit("BFA",["phone" => 57474578, "amount" => 100, "bash" => "D01u35"]);
        // $deposit = (array)$deposit;
        // print_r($deposit);

        /** Sample retrait */
        // $withdraw = $Cinet->withdraw("BFA", ["phone" => 57474578, "amount" => 100, "bash" => "W0001"]);
        // $withdraw = (array)$withdraw;
        // print_r($withdraw);

        /** Sample check balance */
        // $balance = $Cinet->balance('CI');
        // $balance = (array)$balance;
        // print_r($balance);

        /** Sample check balance all */
        // $balance = $Cinet->balance();
        // $balance = (array)$balance;
        // print_r($balance);


    }catch(Exception $e){
        echo "Error: " . $e->getMessage();
    }

?>