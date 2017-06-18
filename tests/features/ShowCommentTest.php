<?php

use App\Comment;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ShowCommentTest extends TestCase
{
    use DatabaseTransactions;

    public function test_the_comments_are_displayed_and_paginated()
    {
        $post = $this->createPost([
            'title' => 'Como instalar Laravel Dusk'
        ]);

        $firstComment = factory(Comment::class)->create([
            'post_id' => $post->id
        ]);

        factory(Comment::class, 20)->create([
            'post_id' => $post->id
        ]);

        $secondComment = factory(Comment::class)->create([
            'post_id' => $post->id
        ]);

        $this->visit($post->url)
            ->dontSee($secondComment->comment)
            ->see($firstComment->comment)
            ->click('2')
            ->seePageIs($post->url . '?page=2')
            ->dontSee($firstComment->comment)
            ->see($secondComment->comment);
    }

    function test_comment_is_displayed_with_its_author()
    {
        $comment = factory(Comment::class)->create();

        $this->visit($comment->post->url)
            ->see($comment->comment)
            ->see($comment->author->name);
    }
}
