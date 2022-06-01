<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\PostoGraduacao;
use App\Models\OrganizacaoMilitar;
use Illuminate\Database\Eloquent\Factories\Factory;

class MilitarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
		$om = OrganizacaoMilitar::where('flgAtivo', 1)
            ->whereHas('secao', function($q) {
                $q->whereNotNull('id');
                $q->where('flgAtivo',1);
            })
            ->inRandomOrder()
            ->first();
		$secao = $om->secao()->where('flgAtivo', 1)->inRandomOrder()->first();
		$postoGraduacao = PostoGraduacao::where('flgAtivo', 1)->inRandomOrder()->first();

        $militar = [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'nomeGuerra' => $this->faker->lastName(),
            'organizacaoMilitar_id' => $om->id,
            'secao_id' => $secao,
            'postoGraduacao_id' => $postoGraduacao->id,
            'ramal' => $this->faker->numerify('###'),
            'telefoneResidencial' => $this->faker->numerify('##########'),
            'telefoneCelular' => $this->faker->numerify('###########'),
            'isAdmin' => false,
            'flgAtivo' => true,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];

        return $militar;
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
