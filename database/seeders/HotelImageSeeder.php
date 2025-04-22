<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HotelImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hotels = [
            [
                'name' => 'Royal Mansour Marrakech',
                'city' => 'Marrakech',
                'rating' => 5.0,
                'price_mad' => 9500.00,
                'description' => 'Luxurious palace hotel with private riads and world-class service.',
                'address' => 'Rue Abou Abbas El Sebti, Marrakech 40000',
                'latitude' => 31.6294,
                'longitude' => -8.0108,
                'image_url' => 'https://mollycarrphotography.com/wp-content/uploads/2019/04/Royal-Mansour-Wedding-Photographer-Molly-Carr-Photography-Marrakech-Destination-Wedding-Morocco-Film-Photographer-51.jpg',
            ],
            [
                'name' => 'Marchica Lagoon Resort',
                'city' => 'Nador',
                'rating' => 4.6,
                'price_mad' => 1500.00,
                'description' => 'Modern resort overlooking the beautiful Marchica lagoon with Mediterranean views.',
                'address' => 'Zone Touristique, Marchica Bay, Nador 62000',
                'latitude' => 35.1746,
                'longitude' => -2.9287,
                'image_url' => 'https://cf.bstatic.com/xdata/images/hotel/max300/334874298.jpg?k=d61fd4077d350089bd288476a65c5f67eb38290b7be79c2ed081260b8a177e93&o=',
            ],
            [
                'name' => 'Four Seasons Casablanca',
                'city' => 'Casablanca',
                'rating' => 4.8,
                'price_mad' => 3200.00,
                'description' => 'Modern luxury hotel overlooking the Atlantic Ocean.',
                'address' => 'Boulevard de la Corniche, Casablanca 20180',
                'latitude' => 33.5950,
                'longitude' => -7.6675,
                'image_url' => 'https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2c/2e/9e/fa/cblhotelexterior.jpg?w=1400&h=800&s=1',
            ],
            [
                'name' => 'Palais Faraj',
                'city' => 'Fes',
                'rating' => 4.6,
                'price_mad' => 1950.00,
                'description' => 'Beautifully restored palace in the Fes medina with panoramic views.',
                'address' => 'Bab Ziat, Quartier Ziat, Fes 30000',
                'latitude' => 34.0609,
                'longitude' => -4.9778,
                'image_url' => 'https://www.momondo.fr/himg/1c/6e/4a/expedia_group-442756-f892b3de-274725.jpg',
            ],
            [
                'name' => 'Sofitel Tamuda Bay',
                'city' => 'Tetouan',
                'rating' => 4.7,
                'price_mad' => 2400.00,
                'description' => 'Modern beachfront resort with Mediterranean influences.',
                'address' => 'Route de Sebta, M\'diq 93200',
                'latitude' => 35.6800,
                'longitude' => -5.3350,
                'image_url' => 'https://y.cdrst.com/foto/hotel-sf/8cfbf/granderesp/sofitel-tamuda-bay-beach-and-spa-general-11f49ea6.jpg',
            ],
            [
                'name' => 'Hilton Tanger City Center',
                'city' => 'Tangier',
                'rating' => 4.5,
                'price_mad' => 1800.00,
                'description' => 'Modern hotel with rooftop pool overlooking the Mediterranean.',
                'address' => 'Place du Maghreb Arabe, Tangier 90000',
                'latitude' => 35.7673,
                'longitude' => -5.8024,
                'image_url' => 'https://cf.bstatic.com/xdata/images/hotel/max1024x768/538047083.jpg?k=0318947d891cbfe01a527b19e401610abd3c4ecdadc31a06de9a65fae676759b&o=&hp=1',
            ],

            [
                'name' => 'Rif Nador Hotel',
                'city' => 'Nador',
                'rating' => 4.2,
                'price_mad' => 850.00,
                'description' => 'Comfortable hotel with views of the Mediterranean and modern amenities.',
                'address' => 'Boulevard Mohammed V, Nador 62000',
                'latitude' => 35.1746,
                'longitude' => -2.9287,
                'image_url' => 'https://www.ahstatic.com/photos/9677_ho_01_p_1024x768.jpg',
            ],
            [
                'name' => 'Atlantic Palace Agadir',
                'city' => 'Agadir',
                'rating' => 4.4,
                'price_mad' => 1400.00,
                'description' => 'Beachfront resort with golf course and traditional Moroccan architecture.',
                'address' => 'Secteur Touristique, Agadir 80000',
                'latitude' => 30.4060,
                'longitude' => -9.6026,
                'image_url' => 'https://pix10.agoda.net/hotelImages/68998/0/647387f24b563152a232ebbbc7733154.jpeg?ce=0&s=614x432',
            ],
            [
                'name' => 'Riad Ouazzane',
                'city' => 'Ouazzane',
                'rating' => 4.0,
                'price_mad' => 600.00,
                'description' => 'Traditional riad with courtyard garden in the historic spiritual city.',
                'address' => 'Rue de la Kasbah, Ouazzane 16200',
                'latitude' => 34.7980,
                'longitude' => -5.5858,
                'image_url' => 'https://www.lokaina-immobilier.com/img_down/20180222155224-riad-maison-d-hote-luxe-piscine-medina-marrakech-a-vendre-en-vente-%20(7).jpg',
            ],
        ];

        foreach ($hotels as $hotel) {
            DB::table('hotels')->insert([
                'name' => $hotel['name'],
                'city' => $hotel['city'],
                'rating' => $hotel['rating'],
                'price_mad' => $hotel['price_mad'],
                'description' => $hotel['description'],
                'address' => $hotel['address'],
                'latitude' => $hotel['latitude'],
                'longitude' => $hotel['longitude'],
                'image_url' => $hotel['image_url'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
