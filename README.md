Learning PHP
==========

## What Is This?

This is the example code that from [Learning PHP](http://shop.oreilly.com/product/0636920043034.do) by David Sklar.

See an error? Report it [here](http://oreilly.com/catalog/errata.csp?isbn=0636920043034), or simply fork and send us a pull request.

If you want a copy of all of the example code snippets in this repo, lick the Download Zip button to the right to download everything.

## How do I use this code?

The `code` directory should contain runnable versions of your code.
The `runner.php` program runs one or more code examples. runner.php --help tells you how to use it:

```
runner.php [--chapter=CHAPTER] [--code=CODE] [--bare] [--fail-first] [--ignore-net-fail] [--cli=CLI]

Runs one or more code examples and reports on success/failure.

  --chapter=CHAPTER     Run code examples from chapter CHAPTER
  --code=CODE           Run code example CODE
  --cli=CLI             Use PHP binary installed at CLI
  --bare                Just run the code, don't report on success/failure
  --fail-first          Exit after first code failure
  --ignore-net-fail     Ignore failures that seem to be from a lack of network

PHP binary configured to run code examples:
   /usr/local/bin/php

--chapter and --code and each be specified more than once.

CHAPTER and CODE are interpreted as shell globs.

CHAPTER should just be the name of a chapter file without extension, e.g. "datetime".

CODE should be the name of a chapter code directory, then /, then the basename of the code example, e.g. "datetime/interval"
```

For example, you can try `runner.php --code=datetime/interval` or `runner.php --chapter=datetime`.

### Install dependencies:

`runner.php` depends on a few things installable by Composer. 

- Run `composer install` from the same directory that `runner.php` is in to install them. 
- Run `composer install` from the `code` subdirectory to install them.

### Executing the code:

If you want `runner.php` to run a piece of code and not run unnecessary checks, provide the `--bare` commandline argument.

> php runner.php --code={chapter}/{exercise} --bare 

Replace the following {chapter} with chapter folder name e.g. data; and {exercise} with php name of the exercise e.g. exercise.1 (don't add .php)

Here's an example: 

> php runner.php --code=data/exercise.1 --bare 

#### End
