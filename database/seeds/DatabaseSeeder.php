<?php

use App\Competicio;
use App\Config;
use App\Edicio;
use App\Estat;
use App\Patrocinador;
use App\Rol;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

    /*
     * php artisan db:seed
     * php artisan migrate:refresh --seed
     */
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

        $this->call('RolTableSeeder');

        $this->command->info('Rols table seeded!');

        $this->call('EstatTableSeeder');

        $this->command->info('Estat table seeded!');

        $this->call('UserTableSeeder');

        $this->command->info('User table seeded!');

        $this->call('EdicioTableSeeder');

        $this->command->info('Edicio table seeded!');

        $this->call('ConfigTableSeeder');

        $this->command->info('Config table seeded!');

        $this->call('CompeticioTableSeeder');

        $this->command->info('Competicio table seeded!');
	}

}

class UserTableSeeder extends Seeder {

    public function run()
    {
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'ultratoken' => md5(uniqid(rand(), true)),
            'password' => bcrypt('admin'),
            'estat_id' => 1,
            'rol_id' => 1,
        ]);
    }

}

class RolTableSeeder extends Seeder {

    public function run()
    {
        Rol::create([
            'name' => 'Admin'
        ]);

        Rol::create([
            'name' => 'Usuari'
        ]);
    }

}

class EstatTableSeeder extends Seeder {

    public function run()
    {
        Estat::create([
            'name' => 'Pendent'
        ]);

        Estat::create([
            'name' => 'Validat'
        ]);
    }

}

class ConfigTableSeeder extends Seeder {

    public function run()
    {

        Config::create([
            'data_inici' => date('Y-m-d H:i:s'),
            'email' => 'lanparty@iesebre.com',
            'edicio_id' => 1
        ]);
    }

}

class EdicioTableSeeder extends Seeder {

    public function run()
    {

        Edicio::create([
            'name' => 'Edició exemple',
            'cartell' => 'cartell.png'
        ]);
    }

}

class CompeticioTableSeeder extends Seeder {

    public function run()
    {
        Competicio::create([
            'name' => 'League of Legends',
            'logo' => 'lol.png',
            'imatge' => 'lol-grande.png',
            'number' => 5,
            'link' => '',
            'data_inici' => date('Y-m-d H:i:s'),
            'edicio_id' => 1
        ]);

        Competicio::create([
            'name' => 'Hearthstone',
            'logo' => 'hearthstone.ico',
            'imatge' => 'hearthstone-grande.png',
            'number' => 1,
            'link' => '',
            'data_inici' => date('Y-m-d H:i:s'),
            'edicio_id' => 1
        ]);

        Competicio::create([
            'name' => 'Counter Strike - Global Offensive',
            'logo' => 'csgo.jpg',
            'imatge' => 'Counter-Strike_Global_Offensive.jpg',
            'number' => 1,
            'link' => '',
            'data_inici' => date('Y-m-d H:i:s'),
            'edicio_id' => 1
        ]);

        Competicio::create([
            'name' => 'FIFA 15',
            'logo' => 'fifa.ico',
            'imatge' => 'fifa-grande.jpg',
            'number' => 1,
            'link' => '',
            'data_inici' => date('Y-m-d H:i:s'),
            'edicio_id' => 1
        ]);

        Competicio::create([
            'name' => 'Muntatge d\'ordinadors',
            'logo' => 'tools.png',
            'imatge' => 'montaje.png',
            'number' => 2,
            'link' => '',
            'data_inici' => date('Y-m-d H:i:s'),
            'edicio_id' => 1
        ]);

        Competicio::create([
            'name' => 'Programació',
            'logo' => 'java.png',
            'imatge' => 'coder.png',
            'number' => 2,
            'link' => '',
            'data_inici' => date('Y-m-d H:i:s'),
            'edicio_id' => 1
        ]);
    }

}

class PatrocinadorsTableSeeder extends Seeder {

    public function run()
    {
        Patrocinador::create([
            'name' => 'Intel',
            'tipus' => 3,
            'logo' => 'prova1.png',
            'edicio_id' => 1
        ]);

        Patrocinador::create([
            'name' => 'Twitch',
            'tipus' => 1,
            'logo' => 'prova2.png',
            'edicio_id' => 1
        ]);

        Patrocinador::create([
            'name' => 'Benq',
            'tipus' => 2,
            'logo' => 'prova3.png',
            'edicio_id' => 1
        ]);
    }

}