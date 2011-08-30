K3-Resque Module
==============

A Ko3 Module by [**John Hobbs**](http://twitter.com/jmhobbs)

Introduction
------------

This module provides easy Resque queueing Kohana 3.1.x.

It currently uses [Redisent](https://github.com/jdp/redisent) for it's Redis connection, and is not terribly complicated.

Installation
------------

K3-Resque is a simple, standard module.

1. Drop the source in your MODPATH folder.
2. Add the module to Kohana::modules in your bootstrap.php

Usage
-----

    $r = new Resque();
    $r->enqueue( 'test', 'ResqueClass', 5 );
    $r->enqueue( 'other', 'AnotherClass', array( 'lots', 'of', 'args' ) );

