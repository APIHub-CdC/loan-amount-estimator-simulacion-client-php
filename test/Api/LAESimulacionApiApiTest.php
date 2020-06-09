<?php

namespace LAESimulacion\Client;

use \LAESimulacion\Client\Api\LAESimulacionApi as LAE_Api;

class LAESimulacionApiTest extends \PHPUnit_Framework_TestCase
{   
    public function setUp()
    {
        $handler = \GuzzleHttp\HandlerStack::create();
        $config = new \LAESimulacion\Client\Configuration();
        $config->setHost('the_url');

        $client = new \GuzzleHttp\Client(['handler' => $handler]);
        $this->apiInstance = new LAE_Api($client, $config);

        $this->x_api_key = "your_api_key";
    }
    
    public function testGetLAEByFolioConsulta()
    {
        $request = new \LAESimulacion\Client\Model\PeticionFolioConsulta();
        $segmento = new \LAESimulacion\Client\Model\CatalogoSegmento();

        $request->setFolioOtorgante("1");
        $request->setSegmento($segmento::PP);
        $request->setFolioConsulta("386636538");
        
        try {
            $result = $this->apiInstance->getLAEByFolioConsulta($this->x_api_key, $request);
            $this->assertTrue($result!==null);
            echo "testGetLAEByFolioConsulta\n";
        } catch (Exception $e) {
            echo 'Exception when calling LAE_SimulacionApi->getLAEByFolioConsulta: ', $e->getMessage(), PHP_EOL;
        }
    }
}
