<?php

namespace Database\Seeders;

use App\Models\Acreditacio;
use App\Models\OrganAcreditador;
use App\Models\Acred_OrgAcred;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $orgAcred=OrganAcreditador::factory()->count(4)->create();
       
        $acreditacions=Acreditacio::factory()->count(10)->create()
                ->each(function ($acreditacions)use($orgAcred){
                    $acreditacions->OrganAcreditadors()
                            ->attach($orgAcred->random(mt_rand(2,4))
                                    ->pluck('id')
                                    );   
    }
                );
//        \App\Models\OrganAcreditador::factory(4)->create();
//        \App\Models\Acreditacio::factory(15)->create();
    }
}
