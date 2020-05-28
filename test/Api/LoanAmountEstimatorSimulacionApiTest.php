<?php

namespace LoanAmountEstimatorSimulacion\Client;

use \LoanAmountEstimatorSimulacion\Client\Api\LoanAmountEstimatorSimulacionApi as LAE_Api;

class LoanAmountEstimatorSimulacionApiTest extends \PHPUnit_Framework_TestCase
{   
    public function setUp()
    {
        $handler = \GuzzleHttp\HandlerStack::create();
        $config = new \LoanAmountEstimatorSimulacion\Client\Configuration();
        $config->setHost('the_url');

        $client = new \GuzzleHttp\Client(['handler' => $handler]);
        $this->apiInstance = new LAE_Api($client, $config);

        $this->x_api_key = "wygabaWTlFUmpegWc0AMsUAhrUe3t2Wv";
    }

    public function testGetLAEByPerson()
    {
        $request = new \LoanAmountEstimatorSimulacion\Client\Model\PeticionPersona();
        $persona = new \LoanAmountEstimatorSimulacion\Client\Model\Persona();
        $domicilio = new \LoanAmountEstimatorSimulacion\Client\Model\DomicilioPeticion();        
        $estado = new \LoanAmountEstimatorSimulacion\Client\Model\CatalogoEstados();
        $segmento = new \LoanAmountEstimatorSimulacion\Client\Model\CatalogoSegmento();
            
        $domicilio->setDireccion("SAN JOAQUIN");
        $domicilio->setColoniaPoblacion("EL ARENAL");
        $domicilio->setDelegacionMunicipio("IZTAPALAPA");
        $domicilio->setCiudad("MEXICO");
        $domicilio->setEstado($estado::CDMX);
        $domicilio->setCP("12345");

        $persona->setPrimerNombre("JUAN");
        $persona->setApellidoPaterno("PRUEBA");
        $persona->setApellidoMaterno("CUATRO");
        $persona->setFechaNacimiento("1966-05-13");
        $persona->setRFC("PUAC800104");
	
	    $domicilio->setDireccion("INSURGENTES SUR 1004");
	    $domicilio->setColoniaPoblacion("INSURGENTES SUR");
	    $domicilio->setDelegacionMunicipio("CIUDAD DE MEXICO");
	    $domicilio->setCiudad("CIUDAD DE MEXICO");
	    $domicilio->setEstado($estado::CDMX);
	    $domicilio->setCP("11230");
         
        $request->setFolioOtorgante("1");
        $request->setSegmento($segmento::PP);
        $request->setPersona($persona);

        try {
            $result = $this->apiInstance->getLAEByPerson($this->x_api_key, $request);
            $this->assertTrue($result!==null);
            echo "testGetLAEByPerson\n";
        } catch (Exception $e) {
            echo 'Exception when calling LAE_SimulacionApi->getLAEByPerson: ', $e->getMessage(), PHP_EOL;
        }
    }
    
    public function testGetLAEByFolioConsulta()
    {
        $request = new \LoanAmountEstimatorSimulacion\Client\Model\PeticionFolioConsulta();
        $segmento = new \LoanAmountEstimatorSimulacion\Client\Model\CatalogoSegmento();

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
