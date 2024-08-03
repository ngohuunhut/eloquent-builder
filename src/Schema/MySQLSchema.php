<?php

namespace Nhn\Schema;

use DB;
use Illuminate\Support\Collection;
use Nhn\Schema\DatabaseSchema;
use Illuminate\Support\Facades\Schema;

class MySQLSchema
{
    protected array $tables = [];

    // public function __construct(private readonly MySQLRepository $mySQLRepository)
    // {
    // }

    /**
     * @inheritDoc
     */
    public function getTables(): Collection
    {
        return new Collection(Schema::getTableListing());
    }


    /**
     * Get columns from the schema by table name.
     *
     * @return \Illuminate\Support\Collection<int, SchemaColumn>
     */
    public function getColumns(string $table): Collection
    {
        return new Collection(Schema::getColumns($this->stripTablePrefix($table)));
    }

    /**
     * Get indexes from the schema by table name.
     *
     * @return \Illuminate\Support\Collection<int, SchemaIndex>
     */
    public function getSchemaIndexes(string $table): Collection
    {
        return new Collection(Schema::getIndexes($this->stripTablePrefix($table)));
    }

    /**
     * Strips table prefix.
     *
     * @param  string  $table  Table name.
     */
    public function stripTablePrefix(string $table): string
    {
        return substr($table, strlen(DB::getTablePrefix()));
    }
}
