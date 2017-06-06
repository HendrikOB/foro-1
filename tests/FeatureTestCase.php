<?php
/**
 * Created by PhpStorm.
 * User: hendrikob
 * Date: 6/2/17
 * Time: 3:02 PM
 */

use Illuminate\Foundation\Testing\DatabaseTransactions;


class FeatureTestCase extends TestCase
{
    use DatabaseTransactions;

    public function seeErrors(array $fields)
    {
        foreach ($fields as $name => $errors) {
            foreach ((array) $errors as $message) {
                $this->seeInElement(
                    "#field_{$name}.has-error .help-block",
                    $message);
            };
        }


    }
}