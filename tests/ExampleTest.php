<?php

use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->asserTrue(false);

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
