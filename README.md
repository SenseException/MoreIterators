# MoreIterators

[![Build Status](https://travis-ci.org/SenseException/MoreIterators.svg?branch=master)](https://travis-ci.org/SenseException/MoreIterators)

Extending the shipped Iterators of PHP with new Iterators

## Really? More Iterators?

Like the name says, it is a repository with Iterators. Iterators are a underestimated
pattern and can be a help when it is about a traversable data structure. Read more
about PHP Iterator in the official [PHP documentation](http://php.net/manual/en/spl.iterators.php).

Sure, PHP has a lot of Iterators, but still you can do so much more with them and
for the main reason: I love Iterators.

## What kind of Iterator does this repository contain?

### FileContent

* CsvIterator (iterate through a CSV file)

### Mapping

* ValueAsKeyIterator (use a part of the current value as key, like the id of a model object)

### Filter

* UniqueIterator