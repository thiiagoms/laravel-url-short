<?php

namespace Tests\Unit\Services;

use App\Contracts\UrlContract;
use App\Services\UrlService;
use PHPUnit\Framework\TestCase;

/**
 * Url Service Test
 *
 * @package Tests\Unit\Services
 * @author  Thiago Silva <thiagom.devsec@gmail.com>
 * @version 1.0
 */
class UrlServiceTest extends TestCase
{
    private UrlContract $urlContractTest;

    protected function setUp(): void
    {
        $this->urlContractTest = $this->getMockBuilder(UrlContract::class)->getMock();
    }

    final public function test_create_url_short_with_empty_url(): void
    {
        $this->expectException(\App\Exceptions\Url\UrlEmptyException::class);
        $this->expectExceptionMessage('Url can\'t be empty');

        $urlServiceTest = new UrlService($this->urlContractTest);

        $url = '';

        $urlServiceTest->createUrlShort($url);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }
}
