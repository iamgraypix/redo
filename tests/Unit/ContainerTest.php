<?php

use Core\Container;

test('Bindins in Container', function() {
    
    // arrange
    $container = new Container;
    $container->bind('boo', fn() => 'bar');

    // act
    $result = $container->resolve('boo');

    // assert/expect
    expect($result)->toEqual('bar');

});