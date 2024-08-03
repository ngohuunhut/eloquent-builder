<?php

class Person {
    public function name()
    {
        return 'name';
    }
}

class Man extends Person {

    public function sex()
    {
        return 'man';
    }
}

class Woman extends Man {

    public function child()
    {
        return 1;
    }
}


$child = new Woman();

echo $child->child();
echo $child->sex();
echo $child->name();





