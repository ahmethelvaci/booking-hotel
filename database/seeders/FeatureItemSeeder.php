<?php

namespace Database\Seeders;

use App\Models\FeatureItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeatureItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();
        FeatureItem::insert([
            ['name' => 'Çocuk havuzu', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Otopark', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Çocuk klübü', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Kapalı havuz', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Kaydıraklı havuz', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Aquaparklı havuz', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Minibar', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Wifi', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Spa Merkezi', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Tek bay kabul ediyor', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Termal Otel', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Alkolsüz Otel', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Açık havuz', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Klima', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Denize 0-100 mt', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Kum plaj', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Havaalanına Yakın', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Animasyon ekibi', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Otele özel plaj', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Kum-çakıl karışık plaj', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Evcil hayvan kabul ediyor', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
