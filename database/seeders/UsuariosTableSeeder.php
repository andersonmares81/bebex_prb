<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuariosSeeder extends Seeder
{
    public function run()
    {
        $json = file_get_contents(storage_path('database/seeders/files/usuarios.json'));
        $data = json_decode($json, true);

        foreach ($data as $item) {
            DB::table('usuarios')->insert([
                'IDUSUARIO' => $item['id'],
                'NITUSUARIO' => $item['NITUSUARIO'],
                'NOMUSUARIO' => $item['NOMUSUARIO'],
                'CODUSUARIO' => $item['CODUSUARIO'],
                'CLAVEUSUARIO' => $item['CLAVEUSUARIO'],
                'ESTADOUSUARIO' => $item['ESTADOUSUARIO'],
                'CODEMPRESA' => $item['CODEMPRESA'],
                'FECGRA' => $item['FECGRA'],
                'EMAIL' => $item['EMAIL'],
                'FECNAC' => $item['FECNAC'],
                'SEXO' => $item['SEXO'],
                'AVATAR' => $item['AVATAR'],
                'numcelular' => $item['numcelular'],
            ]);
        }
    }
}
