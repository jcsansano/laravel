<?php

namespace Database\Factories;

use App\Model\OrganAcreditador;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Colaborador>
 */
class ColaboradorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'dniColab'=>$this->faker->unique()->randomElement([
                        '20033828T','21997178R','20495327G','74241523F','44774316D','74239545F',
                        '48328444Q','53213714V','79106657C','73568850S','53362670W','48368487Q',
                        '74215804W','48345425T','25386874A','13124283T']),
            'nomColab'=>$this->faker->name(), /*randomElement(['Rosa','Carolina','Assumpció','Sergi',
                        'Maria Carme','Vicent','Jorge','Víctor','Eduard','Tània','Joan','Monica']),*/
            'cognomsColab'=>$this->faker->name(),
                /*randomElement(['Martínez Jiménez','Jover Martínez',
                        'Martínez Jover','Mas Galvany','Mascarell Estruch','Medina Montenegro',
                        'Mellado Coves','Mengual Pascual','Miralles  i Pérez', 'Molina Calatayud',
                        'Molina Mas','Mollà Mollà']),*/
            'correuColab'=>$this->faker->unique()->email(),
            'telefonColab'=>$this->faker->unique()->phoneNumber(), /*randomElement(['653124193','617902215','629748991',
                    '677810641','630643933','658101894','605502156','652354398','678118592','685298260',
                    '692744694','617143485','699030353','695995142'])->nullable(),*/
            'fotoColab'=>$this->faker->optional->text(30),
            'notesColab'=>$this->faker->optional()->paragraph(4)
            
        ];
    }
}
