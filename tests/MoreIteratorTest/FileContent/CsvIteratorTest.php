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

namespace MoreIteratorTest\FileContent;

use MoreIterator\FileContent\CsvIterator;
use PHPUnit_Framework_TestCase;

/**
 * @see \MoreIterator\FileContent\CsvIterator
 *
 * @author Claudio Zizza
 * @group MoreIterator_FileContent
 */
class CsvIteratorTest extends PHPUnit_Framework_TestCase
{
    public function testIteratorStructure()
    {
        $iterator = new CsvIterator(__DIR__ . '/../Fixtures/csv/test1.csv');

        $expected = array(
            array('headline1', 'headline2', 'headline3'),
            array('Foo', '1', '\\\\'),
            array('Bar', '2', '\"'),
            array('Baz', '3', ''),
        );

        $this->assertSame($expected, iterator_to_array($iterator));
    }

    public function testIteratorSpecialCsvChars()
    {
        $iterator = new CsvIterator(__DIR__ . '/../Fixtures/csv/test2.csv', ',', '#', '|');

        $expected = array(
            array('headline1', 'headline2', 'headline3'),
            array('Foo', '1', '||'),
            array('Bar', '2', '|#'),
            array('Baz', '3', ''),
        );

        $this->assertSame($expected, iterator_to_array($iterator));
    }

    /**
     * getIterator should return an Iterator instance like the interface suggests
     */
    public function testGetIterator()
    {
        $iterator = new CsvIterator(__DIR__ . '/../Fixtures/csv/test1.csv');

        $this->assertInstanceOf('\Iterator', $iterator->getIterator());
    }
}
