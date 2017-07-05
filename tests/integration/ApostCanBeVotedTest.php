<?php

use App\Vote;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApostCanBeVotedTest extends TestCase
{
    use DatabaseTransactions;

    function test_a_post_can_be_upvoted()
    {
        $this->actingAs($user = $this->defaultUser());

        $post =$this->createPost();

        Vote::upVote($post);

        $this->assertDatabaseHas('votes', [
            'post_id' => $post->id,
            'user_id' => $user->id,
            'vote' => 1,
        ]);

        $this->assertSame(1, $post->score);
    }

}