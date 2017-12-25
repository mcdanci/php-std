<?php
use think\migration\Seeder;

class BoothSeeder extends Seeder
{
    public function run()
    {
        $data = [];
        $json = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'BoothOriginal.json');
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
                            ($boothJson['type'] == 'blue' ? 1 : null) :
                            null,
                        'is_courtyard' => array_key_exists('is_courtyard', $boothJson) ?
                            ($boothJson['is_courtyard'] ? 1 : null) :
                            null,
                    ];

                    $data[] = $booth;
                }
            }
        }

        unset($data[458], $data[434]);

        $this->insert('booth', $data);
    }
}
