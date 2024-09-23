<?php

it('validate if response message is ok', function () {
    $response = $this->get('/api/');

    $data = $response->json();
    $this->assertEquals('ok', $data["message"]);
});
