<?php

namespace Nhn\Schema;

use Illuminate\Support\Collection;

abstract class DatabaseSchema
{
    abstract public function getTables(): Collection;
    // abstract public function getTableNames(): Collection;
    // abstract public function getTableNames(): Collection;
    // abstract public function getTableNames(): Collection;


}
