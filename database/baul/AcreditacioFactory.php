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
    public function definition()
    {
        $data=date('d/m/Y');
        return [
            
            'nomAcredit'=>$this->faker->randomElement(['Suport','Infraestructura','Comissió','Valencià A2','Valencià B1',
                          'Valencià B2','Valencià C1', 'Valencia C2']),
            'dataAcredit'=>$data,
            'organAcredit'=>$this->faker->text(50),
            'notesAcredit'=>$this->faker->optional->paragraf(4)
            
            //
        ];
    }
}
