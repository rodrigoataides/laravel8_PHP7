<?php

namespace Database\Seeders;

use App\Models\Estado;
use Illuminate\Database\Seeder;

class Estados extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Estado::create(['uf' => 'AC', 'nome' => 'ACRE', 'pais_id' => 37]);
         Estado::create(['uf' => 'AL', 'nome' => 'ALAGOAS', 'pais_id' => 37]);
         Estado::create(['uf' => 'AM', 'nome' => 'AMAZONAS', 'pais_id' => 37]);
         Estado::create(['uf' => 'AP', 'nome' => 'AMAPÁ', 'pais_id' => 37]);
         Estado::create(['uf' => 'BA', 'nome' => 'BAHIA', 'pais_id' => 37]);
         Estado::create(['uf' => 'CE', 'nome' => 'CEARÁ', 'pais_id' => 37]);
         Estado::create(['uf' => 'DF', 'nome' => 'DISTRITO FEDERAL', 'pais_id' => 37]);
         Estado::create(['uf' => 'ES', 'nome' => 'ESPÍRITO SANTO', 'pais_id' => 37]);
         Estado::create(['uf' => 'EX', 'nome' => 'EXTERIOR', 'pais_id' => 37]);
         Estado::create(['uf' => 'GO', 'nome' => 'GOIÁS', 'pais_id' => 37]);
         Estado::create(['uf' => 'MA', 'nome' => 'MARANHÃO', 'pais_id' => 37]);
         Estado::create(['uf' => 'MG', 'nome' => 'MINAS GERAIS', 'pais_id' => 37]);
         Estado::create(['uf' => 'MS', 'nome' => 'MATO GROSSO DO SUL', 'pais_id' => 37]);
         Estado::create(['uf' => 'MT', 'nome' => 'MATO GROSS', 'pais_id' => 37]);
         Estado::create(['uf' => 'PA', 'nome' => 'PARÁ', 'pais_id' => 37]);
         Estado::create(['uf' => 'PB', 'nome' => 'PARAÍBA', 'pais_id' => 37]);
         Estado::create(['uf' => 'PE', 'nome' => 'PERNAMBUCO', 'pais_id' => 37]);
         Estado::create(['uf' => 'PI', 'nome' => 'PIAUÍ', 'pais_id' => 37]);
         Estado::create(['uf' => 'PR', 'nome' => 'PARANÁ', 'pais_id' => 37]);
         Estado::create(['uf' => 'RJ', 'nome' => 'RIO DE JANEIRO', 'pais_id' => 37]);
         Estado::create(['uf' => 'RN', 'nome' => 'RIO GRANDE DO NORTE', 'pais_id' => 37]);
         Estado::create(['uf' => 'RO', 'nome' => 'RONDÔNIA', 'pais_id' => 37]);
         Estado::create(['uf' => 'RR', 'nome' => 'RORAIMA', 'pais_id' => 37]);
         Estado::create(['uf' => 'RS', 'nome' => 'RIO GRANDE DO SUL', 'pais_id' => 37]);
         Estado::create(['uf' => 'SC', 'nome' => 'SANTA CATARINA', 'pais_id' => 37]);
         Estado::create(['uf' => 'SE', 'nome' => 'SERGIPE', 'pais_id' => 37]);
         Estado::create(['uf' => 'SP', 'nome' => 'SÃO PAULO', 'pais_id' => 37]);
         Estado::create(['uf' => 'TO', 'nome' => 'TOCANTINS', 'pais_id' => 37]);
    }
}
