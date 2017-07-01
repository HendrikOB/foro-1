<?php

use App\User;
use Tests\CreatesApplication;
use tests\TestsHelper;

abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
{

    use CreatesApplication, TestsHelper;

}
