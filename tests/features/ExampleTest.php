<?php

use App\User;

class ExampleTest extends FeatureTestCase
{

    function test_basic_example()
    {
        $user = factory(User::class)->create([
            'name' => 'Duilio Palacios',
            'email' => 'admin@styde.net'
        ]);

        $this->actingAs($user, 'api')
            ->visit('api/user')
            ->see('Duilio Palacios')
            ->see('admin@styde.net');
    }
}
