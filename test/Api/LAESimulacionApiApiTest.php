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

    public function testGetLAEByPerson()
    {
        $request = new \LAESimulacion\Client\Model\PeticionPersona();
        $persona = new \LAESimulacion\Client\Model\Persona();
        $domicilio = new \LAESimulacion\Client\Model\DomicilioPeticion();        
        $estado = new \LAESimulacion\Client\Model\CatalogoEstados();
        $segmento = new \LAESimulacion\Client\Model\CatalogoSegmento();
            
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
