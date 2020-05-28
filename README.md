# loan-amount-estimator-simulacion-client-php

Predice el desempeño crediticio futuro para una cuenta específica aprobada previamente. Contiene un conjunto de Scores para cada cuenta representados por un puntaje numérico en un rango definido.

## Requisitos

PHP 7.1 ó superior

### Dependencias adicionales

- Se debe contar con las siguientes dependencias de PHP:
  - ext-curl
  - ext-mbstring
- En caso de no ser así, para linux use los siguientes comandos

```sh
#ejemplo con php en versión 7.3 para otra versión colocar php{version}-curl
apt-get install php7.3-curl
apt-get install php7.3-mbstring
```

- Composer [vea como instalar][1]

## Instalación

Ejecutar: `composer install`

## Guía de inicio

### Paso 1. Agregar el producto a la aplicación

Al iniciar sesión seguir los siguientes pasos:

1.  Dar clic en la sección "**Mis aplicaciones**".
2.  Seleccionar la aplicación.
3.  Ir a la pestaña de "**Editar '@tuApp**' ".
    <p align="center">
      <img src="https://github.com/APIHub-CdC/imagenes-cdc/blob/master/edit_applications.jpg" width="900">
    </p>
4.  Al abrirse la ventana emergente, seleccionar el producto.
5.  Dar clic en el botón "**Guardar App**":
    <p align="center">
      <img src="https://github.com/APIHub-CdC/imagenes-cdc/blob/master/selected_product.jpg" width="400">
    </p>

### Paso 2. Capturar los datos de la petición

Los siguientes datos a modificar se encuentran en **_test/Api/LoanAmountEstimatorSimulacionApiTest.php_**

Es importante contar con el setUp() que se encargará de inicializar la url. Modificar la URL **_('the_url')_** de la petición del objeto **_\$config_**, como se muestra en el siguiente fragmento de código:

```php
public function setUp()
{
  $handler = \GuzzleHttp\HandlerStack::create();
  $config = new \LoanAmountEstimatorSimulacion\Client\Configuration();
  $config->setHost('the_url');

  $client = new \GuzzleHttp\Client(['handler' => $handler]);
  $this->apiInstance = new LAEApi($client, $config);

  $this->x_api_key = "your_api_key";
}

/**
* Este es el método que se será ejecutado en la prueba ubicado en path/to/repository/test/Api/LoanAmountEstimatorSimulacionApiTest.php
*/
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
```

## Pruebas unitarias

Para ejecutar las pruebas unitarias:

```sh
./vendor/bin/phpunit
```

[1]: https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos