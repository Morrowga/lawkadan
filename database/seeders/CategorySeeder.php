<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['ငလျင်ဘေး', 'အထွေထွေ', 'ရေဘေး', 'မီးဘေး', 'ဓားပြမှု', 'လူပျောက်/ပစ္စည်းပျောက်', 'နေစရာမဲ့/စားစရာမဲ့'];

        foreach ($categories as $category) {
            Category::firstOrCreate(['name' => $category]);
        }
    }
}
