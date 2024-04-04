<?php

test('example', function () {
    expect(true)->toBeTrue();
});

test("login renderered successfully", function(){
   $response = $this->get('/login');

   $response->assertStatus(200);
});
