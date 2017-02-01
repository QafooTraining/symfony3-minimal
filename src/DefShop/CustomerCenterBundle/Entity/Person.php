<?php

namespace DefShop\CustomerCenterBundle\Entity;

/**
 * Person
 */
class Person
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var Address[]
     */
    public $addresses = [];
}

