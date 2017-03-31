Lumen Sonata Extends Bundle
========================

Permite de una manera sencilla agregar programación customizada dentro del entorno
de Sonata. Resuelve el problema de la generación de reportes y la manera
de agregar sencillamente un link en el dashboard hacia una sección de programación
customizada o hacia un link externo.

Modo de Uso
========================

Se instala el Bundle y se registra en el AppKernel: 
public function registerBundles()
{
        $bundles = array(
            ...,
            new Lumen\SonataExtendsBundle\LumenSonataExtendsBundle(),
            ...
        );
}

Luego en el config.yml se agrega la configuración de los elementos que se 
quieren desplegar en el dashboard:

lumen_sonata_extends:
    config:
        groups:
            Reportes:
                label: Reportes
                items:
                    'Bitacora':
                        actions:
                            show_bitacora:
                                routingType: 'local' # Utiliza una ruta del sistema
                                routing: 'home_bitacora'
                                label: 'Ver bitacora'
                                roles: []
                    'Algo':
                        actions:
                            show_algo:
                                routingType: 'external' # Utiliza una url absoluta custom.
                                routing: 'http://www.google.com'
                                label: 'Algo'
                                target: '_blank'
                                roles: []


Luego en tu bundle y en el controlador que se va a encargar de gestionar la programación
personalizada, hay que agregar el siguiente namespace:

use Lumen\SonataExtendsBundle\Controller\CustomAdminController as CustomAdminController;

Extender tu controlador de CustomAdminController:

class DefaultController extends CustomAdminController

Una vez hechos estos pasos, ya puedes agregar la programación que se desea.


Cosas a tener en consideración:

Las rutas deben de tener el prefix "/admin" ya que te recuerdo que estamos dentro del contexto
de Sonata y el firewall del security requiere el prefix "/admin" para identificar la 
seguridad del usuario actual. Ejemplo:

lumen_bitacora:
    resource: "@LumenBitacoraBundle/Controller/"
    type:     annotation
    prefix:   /admin





