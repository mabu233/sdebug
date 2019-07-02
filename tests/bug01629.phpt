--TEST--
Test for bug #1629: SOAP Client/Server detection code does not handle inherited classes
--SKIPIF--
<?php
if (!extension_loaded("soap")) { echo "skip SOAP extension required\n"; }
?>
--FILE--
<?php
class SoapAgent extends \SoapClient
{
    public function __construct(string $wsdl)
    {
        try {
            parent::__construct($wsdl);
            echo 'Success!' . PHP_EOL;
        } catch (\Throwable $t) {
            echo $t->GetMessage(), "\n";
        }
    }
}

$client = new SoapAgent('test');
?>
--EXPECT--
SOAP-ERROR: Parsing WSDL: Couldn't load from 'test' : failed to load external entity "test"
