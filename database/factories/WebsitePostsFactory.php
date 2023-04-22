<?php

namespace Database\Factories;

use App\Models\WebsitePostsModel;
use App\Models\WebsitesModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class WebsitePostsFactory extends Factory
{

    protected $model = WebsitePostsModel::class;


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'website_id' => \App\Models\WebsitesModel::factory(1)->create()->all()[0]->site_id,
            'post_title' => $this->faker->text(20),
            'post_desc' => $this->faker->text(100),
            'created_at' => date("Y-m-d H:i:s"),
        ];
    }


}
