<?php

use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Test\CIUnitTestCase;

/**
 * @internal
 */
final class SecurityHelperTest extends CIUnitTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        helper('seguridad');
        session()->destroy();
    }

    protected function tearDown(): void
    {
        session()->destroy();

        parent::tearDown();
    }

    public function testRutaInicioPorRolRetornaCatalogoParaCliente(): void
    {
        $this->assertSame('/rifas/catalogo', rutaInicioPorRol('cliente'));
    }

    public function testRutaInicioPorRolRetornaUsuariosParaPersonalInterno(): void
    {
        $this->assertSame('/usuarios', rutaInicioPorRol('admin'));
        $this->assertSame('/usuarios', rutaInicioPorRol('trabajador'));
    }

    public function testSeguridadRedirigeClienteSinPermisoAlCatalogo(): void
    {
        session()->set('usuario', ['rol' => 'cliente']);

        $response = seguridad(['admin']);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertStringEndsWith('/rifas/catalogo', $response->getHeaderLine('Location'));
    }

    public function testNoSeguridadRedirigeClienteAlCatalogo(): void
    {
        session()->set('usuario', ['rol' => 'cliente']);

        $response = noSeguridad();

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertStringEndsWith('/rifas/catalogo', $response->getHeaderLine('Location'));
    }
}
