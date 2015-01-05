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

namespace MoreIteratorTest\Filter;

use ArrayIterator;
use MoreIterator\Filter\UniqueIterator;
use PHPUnit_Framework_TestCase;

/**
 * @see \MoreIterator\Filter\UniqueIterator
 *
 * @author Claudio Zizza
 * @group MoreIterator_Filter
 */
class UniqueIteratorTest extends PHPUnit_Framework_TestCase
{
    public function testIteratorStructure()
    {
        $iterator = new ArrayIterator(array('foo', 'bar', 'baz', 'bar', 'foo', 'qux'));

        $unique = iterator_to_array(new UniqueIterator($iterator));
        $expected = array(0 => 'foo', 1 => 'bar', 2 => 'baz', 5 => 'qux');

        $this->assertSame($expected, $unique);
    }

    public function testWhileIteration()
    {
        $iterator = new ArrayIterator(array('foo', 'bar', 'baz', 'bar', 'foo', 'qux'));

        $unique = new UniqueIterator($iterator);
        $expected = array(0 => 'foo', 1 => 'bar', 2 => 'baz', 5 => 'qux');

        $actual = array();
        $unique->rewind();
        while ($unique->valid()) {
            $actual[$unique->key()] = $unique->current();
            $unique->next();
        }

        $this->assertSame($expected, $actual);
    }
}
