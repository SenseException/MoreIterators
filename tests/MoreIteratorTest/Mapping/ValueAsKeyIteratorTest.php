<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 */

namespace MoreIteratorTest\Mapping;

use MoreIterator\Mapping\ValueAsKeyIterator;
use PHPUnit_Framework_TestCase;

/**
 * @see \MoreIterator\Mapping\ValueAsKeyIterator
 *
 * @author Claudio Zizza
 * @license MIT
 * @group MoreIterator_Mapping_ValueAsKeyIterator
 */
class ValueAsKeyIteratorTest extends PHPUnit_Framework_TestCase
{
    public function testIteration()
    {
        $array = array(
            array('id' => 1, 'value' => 'Foo'),
            array('id' => 2, 'value' => 'Bar'),
            array('id' => 3, 'value' => 'Baz'),
        );
        $function = function($current) {
            return $current['id'];
        };

        $iterator = new ValueAsKeyIterator($array, $function);

        $expected = array(
            1 => array('id' => 1, 'value' => 'Foo'),
            2 => array('id' => 2, 'value' => 'Bar'),
            3 => array('id' => 3, 'value' => 'Baz'),
        );

        $this->assertSame($expected, iterator_to_array($iterator));
    }
}
