<?php

use App\Post;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserModelTest extends TestCase
{
    use DatabaseTransactions;

    public function test_method_owns_of_model_user_works()
    {
        $user = $this->defaultUser();

        $firstPost = factory(Post::class)->create([
            'user_id' => $user->id
        ]);

        $secondPost = factory(Post::class)->create();

        $this->assertTrue($user->owns($firstPost));
        $this->assertFalse($user->owns($secondPost));
    }
}
