<?php
/**
 * Created by PhpStorm.
 * User: hendrikob
 * Date: 6/2/17
 * Time: 3:02 PM
 */

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\CreatesApplication;
use Tests\TestsHelper;


class FeatureTestCase extends \Laravel\BrowserKitTesting\TestCase
{
    use CreatesApplication, TestsHelper,DatabaseTransactions;

    public function seeErrors(array $fields)
    {
        foreach ($fields as $name => $errors) {
            foreach ((array) $errors as $message) {
                $this->seeInElement(
                    "#field_{$name}.has-error .help-block",
                    $message);
            }
        }
    }
}
