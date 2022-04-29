<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrganAcreditador>
 */
class OrganAcreditadorFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()    {
//        $factory->define(App\Models\Acreditacio::class, function(Faker $faker){
//           $acreditacions= App\Models\Acreditacio::all();
//           
        return [
            'nomOrgAcred'=>$this->faker->randomElement([
                'JQCV','CIEACOVA','EOI','GePOL'])
        ];
//        });
    }
}
