<?php

namespace Root\Example;

use Root\Example\Infrastructure\Persistence\Seeders\DatabaseSeeder;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider as SpatiePackageServiceProvider;

class PackageServiceProvider extends SpatiePackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('zoho-api')
            ->hasConfigFile('zoho')
            ->discoversMigrations()
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->askToRunMigrations()
                    ->endWith(function (InstallCommand $command) {
                        $command->call('db:seed', [
                            '--class' => DatabaseSeeder::class,
                        ]);
                    });
            });
    }
}
