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

namespace MoreIterator\Mapping;

use ArrayIterator;
use Closure;

/**
 * An Iterator, where the current value or a part of it can be used as a key
 *
 * @author Claudio Zizza
 * @license MIT
 */
class ValueAsKeyIterator extends ArrayIterator
{

    /**
     * @var Closure
     */
    private $getKeyValue;

    /**
     * @param array $array
     * @param Closure $getKeyValue
     */
    public function __construct(array $array, Closure $getKeyValue)
    {
        parent::__construct($array);
        $this->getKeyValue = $getKeyValue;
    }

    /**
     * @return mixed
     */
    public function key()
    {
        $function = $this->getKeyValue;
        return $function($this->current());
    }
}
