<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Entities\EntrySegmentType;

class SegmentTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('entry_segment_types')->insert([
            [
                'code' => EntrySegmentType::TYPE_PREFIX,
                'name' => 'Prefix',
            ],
            [
                'code' => EntrySegmentType::TYPE_ROOT,
                'name' => 'Root',
            ],
            [
                'code' => EntrySegmentType::TYPE_SUFFIX,
                'name' => 'Suffix',
            ],
        ]);
    }
}
