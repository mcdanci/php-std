<?php
use think\migration\Seeder;

class RegSeeder extends Seeder
{
    /**
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     * @todo
     */
    public function run()
    {
        static $TABLE = 'reg';
        static $DATE_FORMAT = 'Y-m-d H:i:s';

        $data = $log = [];

        //for ($i = 0; $i < 100; $i++) {
        //}
        //$this->table('user')->insert($data)->save();

        $faker = Faker\Factory::create();
        for ($i = 0; $i < 100; $i++) {
            $data[] = [
                'created' => $faker->date($DATE_FORMAT),
                'type' => mt_rand(1, 3),
                'name_first' => $faker->firstName,
                'name_last' => $faker->lastName,
                'gender' => mt_rand(1, 3),
                'email' => $faker->email,
                'tel' => $faker->phoneNumber,
                'tel_cell' => '+86 132 123' . mt_rand(0, 9) . ' 432' . mt_rand(0, 9),
                'company' => $faker->company,
                'street' => $faker->streetAddress,
                'city' => $faker->city,
                'iso3166' => $faker->countryCode,
                'website' => 'https://www.sourcethefuture.cc/',
                'cat' => mt_rand(1, 6),
                'password' => $faker->password,
                //'reg_id' => $i > 0 ? mt_rand(1, 9) : null,
            ];
        }

        // Log & password encrypt
        foreach ($data as &$reg) {
            $log[] = [
                'k' => $TABLE,
                'body' => json_encode($reg)
            ];

            $reg['password'] = \app\common\model\Common::encryptPassword($reg['password']);
        }

        $this->insert($TABLE, $data);
        $this->insert('debug', $log);
    }
}
