<?php

namespace Database\Factories;

use App\Models\WebsitesModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class WebsiteFactory extends Factory
{

    protected $model = WebsitesModel::class;


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'site_domain' => $this->faker->domainName(),
        ];
    }


}
