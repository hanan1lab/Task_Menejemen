<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class HakAkses extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $permisions= [
            "Membuat Task",
            "Melihat Task",
            "Mengubah Task",
            "Menghapus Task"
        ];
        foreach($permisions as $n){
            Permission ::create(["name" => $n]);
        }

        $Pengguna = Role ::create(["name"=> "super admin"]);
        $Pengguna->givePermissionTo(Permission::all());

        $Pengguna= Role :: create(["name"=>"Konsumen"]);
        $Pengguna->givePermissionTo([$permisions[1]]);
        
    }
}
