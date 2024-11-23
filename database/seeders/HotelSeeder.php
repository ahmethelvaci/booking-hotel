<?php

namespace Database\Seeders;

use App\Enums\HotelType;
use App\Enums\RoomType;
use App\Models\FeatureItem;
use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();
        $hotels = [
            ['Adana', 'Aladağ', 1],
            ['Adana', 'Ceyhan', 2],
            ['Antalya', 'Akseki', 16],
            ['Antalya', 'Aksu', 17],
            ['Erzurum', 'Aşkale', 35],
            ['Erzurum', 'Aziziye', 36],
            ['Van', 'Bahçesaray', 55],
            ['Van', 'Başkale', 56],
            ['İzmir', 'Aliağa', 68],
            ['İzmir', 'Balçova', 69],
            ['Aydın', 'Bozdoğan', 98],
            ['Aydın', 'Buharkent', 99],
            ['Gaziantep', 'Araban', 115],
            ['Gaziantep', 'İslahiye', 116],
            ['Şanlıurfa', 'Akçakale', 124],
            ['Şanlıurfa', 'Birecik', 125],
            ['Ankara', 'Akyurt', 137],
            ['Ankara', 'Altındağ', 138],
            ['Konya', 'Ahırlı', 162],
            ['Konya', 'Akören', 163],
            ['İstanbul', 'Adalar', 193],
            ['İstanbul', 'Arnavutköy', 194],
            ['Edirne', 'Enez', 232],
            ['Edirne', 'Havsa', 233],
            ['Samsun', '19 Mayıs', 241],
            ['Samsun', 'Alaçam', 242],
            ['Trabzon', 'Akçaabat', 258],
            ['Trabzon', 'Araklı', 259],
        ];

        $hotelTypes = HotelType::cases();

        $rooms = [
            'Tek Kişilik Oda',
            'Çift Kişilik Oda',
            'Üç Kişilik Oda',
            'Dört Kişilik Aile Odası'
        ];

        $roomTypes = RoomType::cases();

        $featureItems = FeatureItem::all();

        foreach ($hotels as $hotel) {
            $hotelId = Hotel::insertGetId([
                'region_id' => $hotel[2],
                'name' => "{$hotel[0]} {$hotel[1]} Hotel",
                'about' => fake()->text(),
                'type' => $hotelTypes[fake()->numberBetween(0,3)]->value,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            $price = fake()->numberBetween(80, 120);
            $roomType = $roomTypes[fake()->numberBetween(0,3)]->value;

            foreach($rooms as $room) {
                Room::insert([
                    'hotel_id' => $hotelId,
                    'name' => $room,
                    'about' => fake()->text(),
                    'type' => $roomType,
                    'price_per_person' => $price * 1000,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
                $price *= 1.2;
            }

            Hotel::find($hotelId)->feature_items()->attach($featureItems->random(5));
        }
    }
}
