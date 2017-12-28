<?php
use think\migration\Seeder;

class BoothSeeder extends Seeder
{
    /**
     * @todo 覈對 zone 同 id
     */
    public function run()
    {
        /**
         * @todo
         */
        $vType = [
            'he' => 3,
            'ia' => 4,
        ];

        $data = [];
        $json = file_get_contents(__DIR__ . DS . 'BoothOriginal.json');
        $json = json_decode($json, true);

        foreach ($json as $zone => &$zoneData) {
            foreach ($zoneData as &$boothJson) {
                if ($boothJson) {
                    $booth = [
                        'id' => (int)$boothJson['booth_id'],
                        'x' => (float)$boothJson['x'],
                        'y' => (float)$boothJson['y'],
                        'zone' => \app\common\model\Helper::getIdByA($zone),
                        'type' => array_key_exists('type', $boothJson) ?
                            ($boothJson['type'] == 'blue' ? $vType['he'] : null) :
                            null,
                        'is_courtyard' => array_key_exists('is_courtyard', $boothJson) ?
                            ($boothJson['is_courtyard'] ? 1 : null) :
                            null,
                    ];

                    if ($zone === 'A') {
                        $booth['type'] = $vType['ia'];
                    } elseif ($booth['is_courtyard']) {
                        $booth['type'] = $vType['he'];
                    }

                    $data[$booth['id']] = $booth;
                }
            }
        }

        unset($data[458], $data[434]);
        $data = array_values($data);

        $this->insert('booth', $data);
    }
}
