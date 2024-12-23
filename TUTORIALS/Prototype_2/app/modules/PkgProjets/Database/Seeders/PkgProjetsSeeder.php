<?php

namespace Modules\PkgProjets\Database\Seeders;

use Illuminate\Database\Seeder;
use Symfony\Component\Uid\NilUuid;

use Modules\PkgProjets\Database\Seeders\{
    ProjetsSeeder,
    TagsSeeder
};


class PkgProjetsSeeder extends Seeder
{

    public function run(): void
    {
        $this->call([
            ProjetsSeeder::class,
            TagsSeeder::class
        ]);
    }
}