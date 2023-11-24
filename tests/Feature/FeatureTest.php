<?php 

test('example', function(){

   $response = $this->get('/installer');
   $response->assertStatus(200);

});

