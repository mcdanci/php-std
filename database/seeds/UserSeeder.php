<?php

use think\migration\Seeder;

class UserSeeder extends Seeder
{
    /**
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $data = $log = [];

        //for ($i = 0; $i < 100; $i++) {
        //}
        //$this->table('user')->insert($data)->save();

        $faker = Faker\Factory::create();
        for ($i = 0; $i < 100; $i++) {
            $data[] = [
                'created' => date('Y-m-d H:i:s'),
                'username' => $faker->email,
                'password' => $faker->password,
                'reg_id' => $i > 0 ? mt_rand(1, 9) : null,
            ];
        }

        // Log & password encrypt
        foreach ($data as &$user) {
            $log[] = [
                'k' => 'user',
                'body' => json_encode([
                    'username' => $user['username'],
                    'password' => $user['password'],
                ])
            ];

            $user['password'] = \app\phase2\model\Common::encryptPassword($user['password']);
        }

        $this->insert('member', $data);
        $this->insert('debug', $log);
    }
}
