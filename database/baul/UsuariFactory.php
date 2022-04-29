<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuari>
 */
class UsuariFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'NIFUsuari'=>$this->faker->unique()->randomElement([
                '20033828T','21997178R','20495327G','74241523F','44774316D','74239545F',
                '48328444Q','53213714V','79106657C','73568850S','53362670W','48368487Q',
                '74215804W','48345425T','25386874A','13124283T']),
            'perfilUsuari'=>$this->faker->randomElement([
                'Administrador','Col·laborador','Responsable']),
            'passwdUsuari'=>$this->faker->text(250),
            'nomUsuari'=>$this->faker->randomElement([
                'Rosa','Carolina','Assumpció','Sergi','Maria Carme','Vicent','Jorge',
                'Víctor','Eduard','Tània','Joan','Monica']),
            'cognomsUsuari'=>$this->faker->randomElement([
                'Martínez Jiménez','Jover Martínez','Martínez Jover','Mas Galvany',
                'Mascarell Estruch','Medina Montenegro','Mellado Coves','Mengual Pascual',
                'Miralles  i Pérez','Molina Calatayud','Molina Mas','Mollà Mollà']),
            'telefonUsuari'=>$this->faker->optional()->randomElement([
                '653124193','617902215','629748991','677810641','630643933','658101894',
                '605502156','652354398','678118592','685298260','692744694','617143485',
                '699030353','695995142']),
            'correuUsuari'=>$this->faker->unique()->email(),
            'fotoUsuari'=>$this->faker->optional()->text(50),
            'notesUsuari'=>$this->faker->optional()->paragraph(4)];
    }
}
