<?php
use think\migration\Seeder;

class BoothSeeder extends Seeder
{
    const TYPE_HE = 4;
    const TYPE_IA = 5;

    /**
     * @todo 覈對 zone 同 id
     */
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
                            ($boothJson['type'] == 'blue' ? self::TYPE_HE : null) :
                            null,
                        'is_courtyard' => array_key_exists('is_courtyard', $boothJson) ?
                            ($boothJson['is_courtyard'] ? self::TYPE_HE : null) :
                            null,
                    ];

                    if ($zone === 'A') {
                        $booth['type'] = self::TYPE_IA;
                    } elseif ($booth['is_courtyard']) {
                        $booth['type'] = self::TYPE_HE;
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
