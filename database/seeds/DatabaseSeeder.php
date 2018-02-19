<?php

use App\Competition;
use App\Config;
use App\Edition;
use App\State;
use App\Sponsor;
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

      $this->call('StateTableSeeder');

      $this->command->info('State table seeded!');

      $this->call('UserTableSeeder');

      $this->command->info('User table seeded!');

      $this->call('EditionTableSeeder');

      $this->command->info('Edition table seeded!');

      $this->call('ConfigTableSeeder');

      $this->command->info('Config table seeded!');

      $this->call('CompetitionTableSeeder');

      $this->command->info('Competition table seeded!');

      $this->call('SponsorsTableSeeder');

      $this->command->info('Sponsors table seeded!');


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
            'state_id' => 1,
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

class StateTableSeeder extends Seeder {

    public function run()
    {
        State::create([
            'name' => 'Pendent'
        ]);

        State::create([
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
            'description' => 'Organització de jocs tal cual',
            'direction' => 'avinguda tal',
            'edition_id' => 1
        ]);
    }

}

class EditionTableSeeder extends Seeder {

    public function run()
    {

        Edition::create([
            'name' => 'Edició exemple',
            'cartell' => 'cartell.png'
        ]);
    }

}

class CompetitionTableSeeder extends Seeder {

    public function run()
    {
        Competition::create([
            'name' => 'League of Legends',
            'logo' => 'lol.png',
            'imatge' => 'lol-grande.png',
            'number' => 5,
            'link' => '',
            'data_inici' => date('Y-m-d H:i:s'),
            'edition_id' => 1
        ]);

        Competition::create([
            'name' => 'Hearthstone',
            'logo' => 'hearthstone.ico',
            'imatge' => 'hearthstone-grande.png',
            'number' => 1,
            'link' => '',
            'data_inici' => date('Y-m-d H:i:s'),
            'edition_id' => 1
        ]);

        Competition::create([
            'name' => 'Counter Strike - Global Offensive',
            'logo' => 'csgo.jpg',
            'imatge' => 'Counter-Strike_Global_Offensive.jpg',
            'number' => 1,
            'link' => '',
            'data_inici' => date('Y-m-d H:i:s'),
            'edition_id' => 1
        ]);

        Competition::create([
            'name' => 'FIFA 15',
            'logo' => 'fifa.ico',
            'imatge' => 'fifa-grande.jpg',
            'number' => 1,
            'link' => '',
            'data_inici' => date('Y-m-d H:i:s'),
            'edition_id' => 1
        ]);

        Competition::create([
            'name' => 'Muntatge d\'ordinadors',
            'logo' => 'tools.png',
            'imatge' => 'montaje.png',
            'number' => 2,
            'link' => '',
            'data_inici' => date('Y-m-d H:i:s'),
            'edition_id' => 1
        ]);

        Competition::create([
            'name' => 'Programació',
            'logo' => 'java.png',
            'imatge' => 'coder.png',
            'number' => 2,
            'link' => '',
            'data_inici' => date('Y-m-d H:i:s'),
            'edition_id' => 1
        ]);
    }

}

class SponsorsTableSeeder extends Seeder {

    public function run()
    {
        Sponsor::create([
            'name' => 'Intel',
            'type' => 3,
            'logo' => 'prova1.png',
            'edition_id' => 1
        ]);

        Sponsor::create([
            'name' => 'Twitch',
            'type' => 1,
            'logo' => 'prova2.png',
            'edition_id' => 1
        ]);

        Sponsor::create([
            'name' => 'Benq',
            'type' => 2,
            'logo' => 'prova3.png',
            'edition_id' => 1
        ]);
    }

}
