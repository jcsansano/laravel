<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Acreditacio>
 */
class AcreditacioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() {
//        $factory->define(App\Models\OrganAcreditardor::class, function(Faker $faker){
//            $orgAcreds= OrganAcreditador::all();
//            $dataAcredit=$faker->date('d-m-Y');
        return ['nomAcredit'=>$this->faker->randomElement([
                'Infraestructura','Comissió','suport','EO-A1','EO-A2',
                'EO-B1','EO-B2','EO-C1','EO-C2']),
                //'dataAcredit'=>$this->faker->date('Y-m-d'),
                'pesAcredit'=>rand(10, 100),
                'notesAcredit'=>$this->faker->optional()->paragraph(2),
            ];
        
//        });
    }
}
