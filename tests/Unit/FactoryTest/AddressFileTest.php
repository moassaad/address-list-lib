<?php

namespace Moassaad\Addressia\Tests\Unit\FactoryTest;


use Moassaad\Addressia\Factory\AddressFile;
use PHPUnit\Framework\TestCase;

class AddressFileTest extends TestCase
{
    public function test_read_file_as_array_type()
    {
        $content = new AddressFile();
        $this->assertTrue($content->isArray());
    }
}
