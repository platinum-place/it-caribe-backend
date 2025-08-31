<?php

namespace Root\Vehicles;

use Root\Vehicles\Infrastructure\Persistence\Seeders\DatabaseSeeder;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider as SpatiePackageServiceProvider;

class PackageServiceProvider extends SpatiePackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('vehicles')
            ->hasConfigFile('vehicles')
            ->discoversMigrations()
            ->runsMigrations()
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->endWith(function (InstallCommand $command) {
                        $command->call('db:seed', [
                            '--class' => DatabaseSeeder::class,
                        ]);
                    });
            });
    }
}
