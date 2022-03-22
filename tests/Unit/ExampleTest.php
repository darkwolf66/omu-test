<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_if_result_and_data_are_not_null_in_the_right_scenarios()
    {
        $this->assertNotEmpty(standardHttpResponse(null, null)->result);
        $this->assertNotEmpty(standardHttpResponse('success', null)->result);
        $this->assertNotEmpty(standardHttpResponse('success', "DATA")->data);
        $this->assertNotEmpty(standardHttpResponse('error', null)->result);
    }
}
