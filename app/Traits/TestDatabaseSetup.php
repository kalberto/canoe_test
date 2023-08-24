<?php

namespace App\Traits;

use Illuminate\Contracts\Console\Kernel;

trait TestDatabaseSetup
{
    protected static bool $migrated = false;

    public function setupDatabase(): void
    {
        $this->setupTestDatabase();
    }

    protected function setupTestDatabase(): void
    {
        if (! static::$migrated) {
            $this->artisan('migrate:refresh');
            $this->app[Kernel::class]->setArtisan(null);
            static::$migrated = true;
        }
        $this->beginDatabaseTransaction();
    }

    public function beginDatabaseTransaction(): void
    {
        $database = $this->app->make('db');

        foreach ($this->connectionsToTransact() as $name) {
            $database->connection($name)->beginTransaction();
        }

        $this->beforeApplicationDestroyed(function () use ($database) {
            foreach ($this->connectionsToTransact() as $name) {
                $database->connection($name)->rollBack();
            }
        });
    }

    protected function connectionsToTransact(): array
    {
        return property_exists($this, 'connectionsToTransact')
            ? $this->connectionsToTransact : [null];
    }
}
