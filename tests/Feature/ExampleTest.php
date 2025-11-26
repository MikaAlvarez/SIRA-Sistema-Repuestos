<?php

test('la ruta principal redirige al login si no está autenticado', function () {
    $response = $this->get('/');

    $response->assertStatus(302);
    $response->assertRedirect('/login');
});
