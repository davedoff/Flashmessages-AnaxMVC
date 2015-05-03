<?php

namespace Dahc\Flashmessage;

/**
 * A testclass
 * 
 */
class FlashmessageTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test
     *
     * @return void
     *
     */
    public function testError()
    {
        $flashmessage = new \dahc\Flashmessage\Flashmessage();

        $res = $flashmessage->Error();
        $exp = $this->addMessage('error', $content);
        $this->assertEquals($res, $exp, "The name does not match.");
    }
}
