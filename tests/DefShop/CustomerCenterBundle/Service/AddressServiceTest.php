<?php

namespace DefShop\CustomerCenterBundle\Service;

class AddressServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \OutOfBoundsException
     */
    public function testDoNotFindAddress()
    {
        $addressService = new AddressService();
        $addressService->getAddressForName('unknown');
    }

    public function testFindAddressForKore()
    {
        $addressService = new AddressService();

        $address = $addressService->getAddressForName('kore');

        $this->assertEquals(
            new Address([
                'street' => 'Büngeler Straße 64',
                'zip' => 46539,
                'city' => 'Dinslaken',
                'country' => 'Germany',
            ]),
            $address
        );
    }
}