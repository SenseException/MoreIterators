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

namespace MoreIteratorTest\MockHelper;

use PHPUnit_Framework_TestCase;

/**
 * @see \MoreIterator\Mapping\ValueAsKeyIterator
 *
 * @author Claudio Zizza
 * @license MIT
 */
class IteratorMockBuilderTest extends PHPUnit_Framework_TestCase
{
    public function testMockIteratorMethods()
    {
        $iterator = $this->getMock('\Iterator');
        $structure = array(
            3 => 'Foo',
            4 => 'Bar',
            6 => 'Baz',
        );

        $builder = new IteratorMockBuilder();
        $builder->mockIteratorMethods($iterator, $structure);

        $this->assertSame($structure, iterator_to_array($iterator));
    }

    public function testMockIteratorMethodsCallMethodsSeparate()
    {
        $iterator = $this->getMock('\Iterator');
        $structure = array(
            3 => 'Foo',
            4 => 'Bar',
            6 => 'Baz',
        );

        $builder = new IteratorMockBuilder();
        $builder->mockIteratorMethods($iterator, $structure);

        $iterator->rewind();
        $this->assertTrue($iterator->valid());
        $this->assertSame('Foo', $iterator->current());
        $this->assertSame(3, $iterator->key());
        $iterator->next();
        $this->assertTrue($iterator->valid());
        $this->assertSame('Bar', $iterator->current());
        $this->assertSame(4, $iterator->key());
        $iterator->next();
        $this->assertTrue($iterator->valid());
        $this->assertSame('Baz', $iterator->current());
        $this->assertSame(6, $iterator->key());
        $iterator->next();
        $this->assertFalse($iterator->valid());
    }

    /**
     * @expectedException PHPUnit_Framework_MockObject_RuntimeException
     */
    public function testMockIteratorMethodsNotAnIterator()
    {
        $iterator = $this->getMock('\IteratorAggregate');
        $structure = array(
            3 => 'Foo',
            4 => 'Bar',
            6 => 'Baz',
        );

        $builder = new IteratorMockBuilder();
        $builder->mockIteratorMethods($iterator, $structure);
    }
}
