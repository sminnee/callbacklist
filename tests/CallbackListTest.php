<?php

namespace Sminnee\CallbackList\Tests;

use PHPUnit\Framework\TestCase;
use Sminnee\CallbackList\CallbackList;

class CallbackLisTest extends TestCase
{
    public function testCall()
    {
        $list = new CallbackList();

        $log = [];

        $list->add(function () use (&$log) {
            $log[] = 'a';
        });
        $list->add(function () use (&$log) {
            $log[] = 'b';
        });
        $list->add(function () use (&$log) {
            $log[] = 'c';
        });

        $list->call();
        $this->assertEquals(['a', 'b', 'c'], $log);
    }

    public function testCallWithArgs()
    {
        $list = new CallbackList();

        $log = [];
        $list->add(function ($greeting, $punctuation = '') use (&$log) {
            $log[] = "$greeting, a$punctuation";
        });
        $list->add(function ($greeting, $punctuation = '') use (&$log) {
            $log[] = "$greeting, b$punctuation";
        });
        $list->add(function ($greeting, $punctuation = '') use (&$log) {
            $log[] = "$greeting, c$punctuation";
        });

        $log = [];
        $list->call('Hello');
        $this->assertEquals(['Hello, a', 'Hello, b', 'Hello, c'], $log);

        $log = [];
        $list->call('Hello', '!');
        $this->assertEquals(['Hello, a!', 'Hello, b!', 'Hello, c!'], $log);
    }
    public function testGetAll()
    {
        $a = function () {
            echo 'a';
        };
        $b = function () {
            echo 'b';
        };

        $list = new CallbackList();
        $list->add($a);
        $list->add($b);

        $this->assertEquals([$a, $b], $list->getAll());
    }

    public function testGetNamed()
    {
        $a = function () {
            echo 'a';
        };
        $b = function () {
            echo 'b';
        };

        $list = new CallbackList();
        $list->add($a, 'a');
        $list->add($b, 'b');

        $this->assertEquals($a, $list->get('a'));
        $this->assertEquals($a, $list->get('b'));
    }

    public function testRemoveNamed()
    {
        $a = function () {
            echo 'a';
        };
        $b = function () {
            echo 'b';
        };

        $list = new CallbackList();
        $list->add($a, 'a');
        $list->add($b, 'b');
        $list->remove('a');

        $this->assertEquals([$b], $list->getAll());
    }

    public function testClear()
    {
        $a = function () {
            echo 'a';
        };
        $b = function () {
            echo 'b';
        };
        $c = function () {
            echo 'c';
        };

        $list = new CallbackList();
        $list->add($a);
        $list->add($b);
        $list->clear();
        $list->add($c);

        $this->assertEquals([$c], $list->getAll());
    }
}
