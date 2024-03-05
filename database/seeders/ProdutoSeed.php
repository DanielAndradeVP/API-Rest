<?php

namespace Database\Seeders;

use App\Models\Produtos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdutoSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Produtos::factory(10)->create();
    }
}
