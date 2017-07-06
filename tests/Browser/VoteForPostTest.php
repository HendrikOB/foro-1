<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class VoteForPostTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_a_user_can_vote_for_a_post()
    {
        $user = $this->defaultUser();

        $post = $this->createPost();

        $this->browse(function (Browser $browser) use ($user, $post) {
            $browser->loginAs($user)
                ->visit($post->url)
                ->pressAndwaitFor('+1')
                ->assertSeeIn('current-vote', 1);
        });
    }
}
