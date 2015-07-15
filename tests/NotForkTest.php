<?php

namespace TripleI\NotFork;

class NotForkTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var NotFork
     */
    protected $skeleton;

    protected function setUp()
    {
        parent::setUp();
        $this->skeleton = new NotFork;
    }

    public function testNew()
    {
        $actual = $this->skeleton;
        $this->assertInstanceOf('\TripleI\NotFork\NotFork', $actual);
    }

    public function testException()
    {
        $this->setExpectedException('\TripleI\NotFork\Exception\LogicException');
        throw new Exception\LogicException;
    }
    
}
