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

use Iterator;
use PHPUnit_Framework_MockObject_Matcher_InvokedCount as InvokedCount;
use PHPUnit_Framework_MockObject_MockObject as MockObject;
use PHPUnit_Framework_MockObject_RuntimeException as RuntimeException;
use PHPUnit_Framework_MockObject_Stub_ConsecutiveCalls as ConsecutiveCalls;

/**
 * A builder Class to extend created Mock-Objects by expected iterator method
 * calls
 *
 * @author claudio
 * @todo move this helper into an own library
 */
class IteratorMockBuilder
{
    /**
     * Configures the Iterator methods for the Mock object
     *
     * Configures the Iterator methods for the Mock object by the given structure.
     * Depending on the $structure, the expected method invocation is exactly
     * the count of the elements
     *
     * @param MockObject $mock The mock object which is an iterator
     * @param array $structure data structure that is returned by the iterator
     */
    public function mockIteratorMethods(MockObject $mock, array $structure)
    {
        if (!$mock instanceof Iterator) {
            throw new RuntimeException('MockObject is expected to implement Iterator interface');
        }

        $current = array_values($structure);
        $keys = array_keys($structure);
        $invocationCount = count($structure);

        $mock->expects(new InvokedCount($invocationCount))
            ->method('current')
            ->will(new ConsecutiveCalls($current));

        $mock->expects(new InvokedCount($invocationCount))
            ->method('key')
            ->will(new ConsecutiveCalls($keys));

        $valid = array_fill(0, $invocationCount, true);
        $valid[] = false;
        $mock->expects(new InvokedCount($invocationCount + 1))
            ->method('valid')
            ->will(new ConsecutiveCalls($valid));
    }
}
