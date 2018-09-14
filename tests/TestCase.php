<?php

namespace Tests;

// use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

use Laravel\BrowserKitTesting\Testcase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    public $baseurl = 'http//localhost';
}
