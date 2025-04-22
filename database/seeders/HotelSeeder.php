<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Royal Mansour Marrakech (assuming ID 1)
        DB::table('hotel_images')->insert([
            'hotel_id' => 1,
            'image_url' => 'https://prestigiousvenues.com/wp-content/uploads/2017/03/Luxury-Venue-In-Marrakech-Royal-Mansour-Prestigious-Venues.jpg',
            'caption' => 'Luxurious entrance',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('hotel_images')->insert([
            'hotel_id' => 1,
            'image_url' => 'https://www.royalmansour.com/wp-content/uploads/2023/08/fitness_et_loisirs_3-1024x680.jpg.webp',
            'caption' => 'Private pool',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('hotel_images')->insert([
            'hotel_id' => 1,
            'image_url' => 'https://www.royalmansour.com/wp-content/uploads/2024/06/RM-GRAND-RIAD-1-new.jpg',
            'caption' => 'Suite interior',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Marchica Lagoon Resort (assuming ID 2)
        DB::table('hotel_images')->insert([
            'hotel_id' => 2,
            'image_url' => 'https://marchicaresort.com/media/cache/jadro_resize/rc/skHxwho91738594301/jadroRoot/medias/_alk5198.jpg',
            'caption' => 'Lagoon view',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('hotel_images')->insert([
            'hotel_id' => 2,
            'image_url' => 'https://marchicaresort.com/media/cache/jadro_resize/rc/0mHtmWfk1738594299/jadroRoot/medias/5d6f5ea71de83/_alk5541.jpg',
            'caption' => 'Resort pool',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('hotel_images')->insert([
            'hotel_id' => 2,
            'image_url' => 'https://static.verychic.com/images/34174/en/desktop/marchica_resort_36.jpg',
            'caption' => 'Restaurant',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Four Seasons Casablanca (assuming ID 3)
        DB::table('hotel_images')->insert([
            'hotel_id' => 3,
            'image_url' => 'https://www.fourseasons.com/alt/img-opt/~65.1701.0,0000-0,0000-3000,0000-1687,5000/publish/content/dam/fourseasons/images/web/CBL/CBL_040_original.jpg',
            'caption' => 'Ocean view',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('hotel_images')->insert([
            'hotel_id' => 3,
            'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTsKG3qM_6fcTd9mBZREziB2GYkX_W5DvGiVOhTJy_3Zer8-Uf7y6SYvb57JuQutg5YTgc&usqp=CAU',
            'caption' => 'Luxury suite',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('hotel_images')->insert([
            'hotel_id' => 3,
            'image_url' => 'https://q-xx.bstatic.com/xdata/images/hotel/max500/633883365.jpg?k=67b3a7be8e4abb78075624bf7be65335ebfe6c9bc0c39bc9fb948329790d6394&o=',
            'caption' => 'Rooftop pool',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Palais Faraj (assuming ID 4)
        DB::table('hotel_images')->insert([
            'hotel_id' => 4,
            'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ7aWVwptxdRv0dgdUiRCbc36X903FieQEa4A&usqp=CAU',
            'caption' => 'Palace exterior',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('hotel_images')->insert([
            'hotel_id' => 4,
            'image_url' => 'https://www.palaisfaraj.com/wp-content/uploads/2024/03/luxury-riad-Palais-Faraj-2024.jpg',
            'caption' => 'Traditional courtyard',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('hotel_images')->insert([
            'hotel_id' => 4,
            'image_url' => 'https://www.palaisfaraj.com/wp-content/uploads/2023/03/luxury-hotel-fes-suite-royale-9.jpg',
            'caption' => 'Panoramic terrace',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Sofitel Tamuda Bay (assuming ID 5)
        DB::table('hotel_images')->insert([
            'hotel_id' => 5,
            'image_url' => 'https://cf.bstatic.com/xdata/images/hotel/max1024x768/584374060.jpg?k=ad51c932fb189fbc762a052e5c41fbe818b1b70cef58e28c02d9853566035fe1&o=&hp=1',
            'caption' => 'Beachfront view',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('hotel_images')->insert([
            'hotel_id' => 5,
            'image_url' => 'https://www.hotelscombined.com/himg/c1/37/02/ice-2403517-109999650-232504.jpg',
            'caption' => 'Infinity pool',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('hotel_images')->insert([
            'hotel_id' => 5,
            'image_url' => 'https://dq5r178u4t83b.cloudfront.net/wp-content/uploads/sites/155/2023/04/12121726/6651-41-1170x780.jpg',
            'caption' => 'Deluxe room',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Hilton Tanger City Center (assuming ID 6)
        DB::table('hotel_images')->insert([
            'hotel_id' => 6,
            'image_url' => 'https://dynamic-media-cdn.tripadvisor.com/media/photo-o/11/da/94/7a/hilton-tanger-city-center.jpg?w=700&h=-1&s=1',
            'caption' => 'City skyline view',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('hotel_images')->insert([
            'hotel_id' => 6,
            'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ7Ktn_G8xc1c7v_qOxODiedgNB7Wbto9wA9A&usqp=CAU',
            'caption' => 'Rooftop lounge',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('hotel_images')->insert([
            'hotel_id' => 6,
            'image_url' => 'https://www.hilton.com/im/en/TNGCCHI/1139684/tngcc-twin-executive-room.jpg?impolicy=crop&cw=3750&ch=2812&gravity=NorthWest&xposition=625&yposition=0&rw=1200&rh=900',
            'caption' => 'Executive suite',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Riad Fes (assuming ID 7)
        DB::table('hotel_images')->insert([
            'hotel_id' => 7,
            'image_url' => 'https://ik.imgkit.net/3vlqs5axxjf/external/ik-seo/https://www.cfmedia.vfmleonardo.com/imageRepo/5/0/89/268/701/9677_sl_00_p_3000x2250_O/Hotel-Mercure-Rif-Nador-Recreation.jpg?tr=w-780%2Ch-437%2Cfo-auto',
            'caption' => 'Rooftop terrace',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('hotel_images')->insert([
            'hotel_id' => 7,
            'image_url' => 'https://cf.bstatic.com/xdata/images/hotel/max1024x768/321499994.jpg?k=a39192e322b835dc9a879e80e580e7884be64037a14b930052804476d5ff150c&o=&hp=1',
            'caption' => 'Mediterranean view',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('hotel_images')->insert([
            'hotel_id' => 7,
            'image_url' => 'https://ik.imgkit.net/3vlqs5axxjf/external/ik-seo/https://www.cfmedia.vfmleonardo.com/imageRepo/5/0/89/268/681/9677_sp_00_p_3000x2250_O/Hotel-Mercure-Rif-Nador-Spa.jpg?tr=w-780%2Ch-437%2Cfo-auto',
            'caption' => 'Hammam spa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Atlantic Palace Agadir (assuming ID 8)
        DB::table('hotel_images')->insert([
            'hotel_id' => 8,
            'image_url' => 'https://atlantic-palace-agadir.hotels-agadir.com/data/Images/OriginalPhoto/4291/429176/429176694/agadir-atlantic-palace-golf-thalasso-casino-resort-image-81.JPEG',
            'caption' => 'Luxurious lobby',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('hotel_images')->insert([
            'hotel_id' => 8,
            'image_url' => 'https://dynamic-media-cdn.tripadvisor.com/media/photo-o/19/bd/3d/2b/atlantic-palace-agadir.jpg?w=900&h=500&s=1',
            'caption' => 'Outdoor pool',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('hotel_images')->insert([
            'hotel_id' => 8,
            'image_url' => 'https://pix10.agoda.net/hotelImages/68998/3037568/dbbe961b243af8beaaa44eec58271796.jpeg?ce=0&s=714x532',
            'caption' => 'Comfort room',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        //  Riad Ouazzane(assuming ID 9)
        DB::table('hotel_images')->insert([
            'hotel_id' => 9,
            'image_url' => 'https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2a/67/33/56/caption.jpg?w=1200&h=-1&s=1',
            'caption' => 'Resort overview',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('hotel_images')->insert([
            'hotel_id' => 9,
            'image_url' => 'https://www.riadkheirredine.com/wp-content/uploads/2025/03/Untitled-48.png',
            'caption' => 'Luxurious suite',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('hotel_images')->insert([
            'hotel_id' => 9,
            'image_url' => 'https://www.marrakechrealty.com/wp-content/uploads/2022/04/Accroche-2.jpg',
            'caption' => 'Courtyard garden',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
