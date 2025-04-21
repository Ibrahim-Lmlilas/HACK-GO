<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Destination;

class DestinationSeeder extends Seeder
{
    public function run()
    {
        $destinations = [
            ['Marrakech', 'Jamaa el-Fnaa', 4.5, 'https://upload.wikimedia.org/wikipedia/commons/7/79/Djemaa_el_Fna.jpg'],
            ['Fes', 'Chouara Tannery', 4.4, 'https://upload.wikimedia.org/wikipedia/commons/4/46/Chouara_Tannery_-_154_-_Marokko_Handybilder_2018_-_Fes_%2827347707917%29.jpg'],
            ['Rabat', 'Kasbah of the Udayas', 4.5, 'https://upload.wikimedia.org/wikipedia/commons/9/97/Kasbah_Oudayas_exterior.jpg'],
            ['Casablanca', 'Hassan II Mosque', 4.6, 'https://www.leben-pur.ch/wp-content/uploads/2025/01/Leben-pur-250117-13-48-004-1440x1080.jpg'],
            ['Chefchaouen', 'Blue Streets', 4.7, 'https://traveladdicts.net/wp-content/uploads/2018/05/Chefchaouen-Morocco-shops-rugs-1000x667.jpg.webp'],
            ['Essaouira', 'Skala de la Ville', 4.5, 'https://live.staticflickr.com/8390/8513194765_b829b221cf_k.jpg'],
            ['Agadir', 'Agadir Oufella Ruins', 4.2, 'https://www.infinite-morocco.com/wp-content/uploads/2024/02/Kasbah-of-Agadir-Oufella-2.jpg'],
            ['Ouarzazate', 'Ait Benhaddou', 4.7, 'https://media-cdn.tripadvisor.com/media/attractions-splice-spp-674x446/06/6f/5e/9d.jpg'],
            ['Tanger', 'Cap Spartel', 4.5, 'https://stayhere.ma/wp-content/uploads/2023/08/Explorez-le-Cap-Spartel-Tanger-Guide-Complet-pour-un-Sejour-Inoubliable-1536x1024.webp'],
            ['Ifrane', 'National Park', 4.3, 'https://nationalparks-15bc7.kxcdn.com/images/parks/ifrane/20210214181502-Ifrane%20National%20Park.jpg?width=1170&height=360'],
            ['Meknes', 'Bab Mansour', 4.4, 'https://upload.wikimedia.org/wikipedia/commons/f/f4/Bab_Mansour_gate.jpg'],
            ['Tetouan', 'Old Medina', 4.3, 'https://live.staticflickr.com/4774/40065919074_59f18c1ce4_b.jpg'],
            ['Asilah', 'Asilah Medina', 4.6, 'https://upload.wikimedia.org/wikipedia/commons/4/47/Asilah_seafront.jpg'],
            ['El Jadida', 'Portuguese Cistern', 4.2, 'https://upload.wikimedia.org/wikipedia/commons/e/ee/La_Citerne_portugaise.jpg'],
            ['Nador', 'Mar Chica Lagoon', 4.1, 'https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2c/28/a9/cd/exterior.jpg?w=1400&h=800&s=1'],
            ['Safi', 'Pottery Hill', 4.0, 'https://exploreessaouira.com/wp-content/uploads/2023/03/pottery-kils-Safi-728x546.jpg.webp'],
            ['Taza', 'Friouato Caves', 4.3, 'https://upload.wikimedia.org/wikipedia/commons/1/19/Gouffre332.jpg'],
            ['Errachidia', 'Ziz Valley', 4.4, 'https://upload.wikimedia.org/wikipedia/commons/8/84/Ziz_river_%28js%29.jpg'],
            ['Midelt', 'Jbel Ayachi View', 4.2, 'https://happytrip.ma/wp-content/uploads/2022/01/Sommet-Jbel-Ayachi-gorges-jaafar-randonnee-happy-trip-voyage--960x1149.jpg'],
            ['Khouribga', 'Oued Srou', 4.0, 'https://dynamic-media-cdn.tripadvisor.com/media/photo-o/10/2c/65/67/lac-de-la-ville-de-oued.jpg?w=2000&h=800&s=1'],
            ['Beni Mellal', 'Ain Asserdoun', 4.5, 'https://www.mapexpress.ma/wp-content/uploads/2019/05/Ain-Asserdoun-M.jpg'],
            ['Azilal', 'Ouzoud Falls', 4.7, 'https://www.feelmorocco.travel/wp-content/uploads/2020/06/Ouzoud-waterfalls-in-Marrakech.-Ouzoud-Falls.jpg'],
            ['Zagora', 'Draa Valley', 4.3, 'https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2a/82/08/4e/vallee-du-draa-maroc.jpg?w=1400&h=700&s=1'],
            ['Saidia', 'Saidia Beach', 4.4, 'https://www.toulouse.aeroport.fr/sites/default/files/styles/atb_xlarge/public/jpg/Maroc-oujda-SAIDIA_mxl.jpg?itok=ASkH6K_U']
        ];

        foreach ($destinations as $destination) {
            Destination::create([
                'city' => $destination[0],
                'name' => $destination[1],
                'rating' => $destination[2],
                'image_url' => $destination[3]
            ]);
        }
    }
}
