<?php

namespace di;

class InitialData
{
    private $file;
    private $user;
    private $ingredients;
    private $meals;
    private $content;

    public function __construct(){
        $curr = date('Y-m-d H:i:s');

        $this->file = array(
            array(
                'name' => 'default',
                'path' => '../../assets/user/default/default.svg',
                'type_content' => 'photo',
                'created_at' => $curr,
                'updated_at' => $curr
            ),
            array(
                'name' => 'manfaat-berolahraga',
                'path' => '../../assets/content/manfaat-berolahraga.jpg',
                'type_content' => 'photo',
                'created_at' => $curr,
                'updated_at' => $curr
            ),
            array(
                'name' => 'manfaat-berolahraga',
                'path' => '../../assets/content/manfaat-berolahraga.mp4',
                'type_content' => 'video',
                'created_at' => $curr,
                'updated_at' => $curr
            ),
            array(
                'name' => 'obesitas',
                'path' => '../../assets/content/obesitas.png',
                'type_content' => 'photo',
                'created_at' => $curr,
                'updated_at' => $curr
            ),
            array(
                'name' => 'obesitas',
                'path' => '../../assets/content/obesitas.mkv',
                'type_content' => 'video',
                'created_at' => $curr,
                'updated_at' => $curr
            ),
            array(
                'name' => 'perilaku-hidup-sehat',
                'path' => '../../assets/content/perilaku-hidup-sehat.jpg',
                'type_content' => 'photo',
                'created_at' => $curr,
                'updated_at' => $curr
            ),
            array(
                'name' => 'perilaku-hidup-sehat',
                'path' => '../../assets/content/perilaku-hidup-sehat.mkv',
                'type_content' => 'video',
                'created_at' => $curr,
                'updated_at' => $curr
            ),
            array(
                'name' => 'salad-caesar',
                'path' => '../../assets/meals/salad-caesar.jpg',
                'type_content' => 'photo',
                'created_at' => $curr,
                'updated_at' => $curr
            ),
            array(
                'name' => 'salad-jagung',
                'path' => '../../assets/meals/salad-jagung.jpg',
                'type_content' => 'photo',
                'created_at' => $curr,
                'updated_at' => $curr
            ),
            array(
                'name' => 'salad-roll',
                'path' => '../../assets/meals/salad-roll.jpg',
                'type_content' => 'photo',
                'created_at' => $curr,
                'updated_at' => $curr
            ),
            array(
                'name' => 'salad-som-tum',
                'path' => '../../assets/meals/salad-som-tum.jpg',
                'type_content' => 'photo',
                'created_at' => $curr,
                'updated_at' => $curr
            ),
        );


        $this->content = array(
            array(
                'title' => '',
                'id_file' => 0,
                'id_photo_highlight' => 0,
                'body' =>'',
                'highlight' => '',
                'created_at' => $curr,
                'updated_at' =>$curr
            ),
            array(
                'title' => '',
                'id_file' => 0,
                'id_photo_highlight' => 0,
                'body' =>'',
                'highlight' => '',
                'created_at' => $curr,
                'updated_at' =>$curr
            ),
            array(
                'title' => '',
                'id_file' => 0,
                'id_photo_highlight' => 0,
                'body' =>'',
                'highlight' => '',
                'created_at' => $curr,
                'updated_at' =>$curr
            ),
        );


        $this->meals = array(
            array(
                'title' => 'Resep Salad Jagung',
                'highlight' => 'Pertama ada resep salad dengan bahan utama jagung manis, paprika, timun Jepang, dan brokoli yang renyah serta segar.',
                'description' => "Cara Membuat Salad Jagung:\n\n
                                  Cuci bersih, lalu campur semua bahan sayur. Kemudian sisihkan terlebih dahulu. Aduk rata semua bahan saus, lalu sajikan di wadah terpisah atau langsung tuang ke salad sayuran. Salad jagung siap disajikan sebagai makanan ringan. Santap selagi sayuran masih renyah dan belum layu.",
                'type' => 'breakfast',
                'calorie' => 70,
                'created_at' => $curr,
                'updated_at' => $curr
            ),
            array(
                'title' => 'Resep Caesar Salad',
                'highlight' => 'Caesar salad adalah olahan salad sayur yang sangat populer. Jangan kira resep makanan ini ditemukan saat Julius Caesar berkuasa. Nama caesar salad diambil dari Caesar Cardini, chef dan pengusaha restoran yang menemukan racikannya.',
                'description' => "Cara Membuat Crouton:\n\n
                                  Oles tipis-tipis permukaan roti dengan margarin, kemudian potong dadu.Panaskan minyak goreng, kemudian tumis bawang putih hingga harum. Masukkan potongan roti, lalu aduk rata hingga berwarna agak kecokelatan. Setelah itu angkat crouton dan sisihkan terlebih dahulu.Cara Membuat Salad Dressing:Kocok kuning telur hingga berwarna pucat. Tuang minyak zaitun sedikit demi sedikit sambil terus diaduk hingga kental.Tuangkan air lemon, garam, merica, gula pasir, capers, dan anchovy. Aduk rata, kemudian sisihkan terlebih dahulu.Penyajian:Aduk romaine lettuce dengan saus secukupnya saja.Taburi crouton, daging asap, dan telur rebus. Setelah itu taburi dengan keju parmesan parut.Sajikan caesar salad selagi romain lettuce masih segar dan renyah.",
                'type' => 'breakfast',
                'calorie' => 77,
                'created_at' => $curr,
                'updated_at' => $curr
            ),
            array(
                'title' => 'Resep Salad Roll (Vietnamese Summer Roll)',
                'highlight' => 'Salah satu jenis lumpia yang berasal dari Vietnam adalah goi cuon. Lumpia yang di barat disebut summer rolls ini disajikan dengan sayur-sayuran mentah, bihun tawar, timun, selada, mint, daging babi kukus, dan udang rebus.',
                'description' => "Cara Membuat Summer Roll Vietnam:\n\n
                                  Rebus atau rendam soun dalam air panas sampai lunak. Kemudian tiriskan airnya dan tuangi sedikit minyak wijen agar tidak menggumpal. Iris memanjang timun dan lettuce. Avokad dan bawang perai diiris tipis dengan potongan menyerong. Kacang tanah digerus kasar. Rebus udang yang sudah dikupas dan dibuang ekor serta kepalanya selama 1-2 menit. Kemudian tiriskan airnya dan rendam dalam larutan air, cuka, garam, dan arak masak. Setelah itu belah menjadi 2 bagian dan sisihkan. Rebus paha ayam di dalam air yang sudah dibubuhi garam. Setelah itu iris-iris seukuran satu suapan. Basahi rice paper dengan air panas agar lunak. Jangan sampai berkerut dan menempel. Ambil 2 lembar rice paper, kemudian tumpuk agar summer rolls tidak mudah sobek. Alasi dengan perilla, kemudian letakkan lettuce, avokad, ayam, soun, bawang perai, dan timun di satu sisi. Taburi kacang tanah,kemudian gulung rapi seperti amplop. Sebelum 2 gulungan terakhir, letakkan udang yang sudah dibelah 2 dengan sisi luar menghadap bawah.
Sajikan summer rolls dalam keadaan utuh atau dipotong-potong dengan saus asam manis.",
                'type' => 'breakfast',
                'calorie' => 74,
                'created_at' => $curr,
                'updated_at' => $curr
            ),
            array(
                'title' => 'Resep Salad Pepaya Muda Thailand (Som Tum)',
                'highlight' => 'Som tum adalah salad pepaya muda dari Thailand. Rasanya asam, manis, gurih, dan pedas. Segarnya bumbu dengan citarasa asam, kecap ikan, dan kacang tanah membuat rasanya semakin istimewa.',
                'description' => "Cara Membuat Som Tum:\n\n
                                  Siapkan ulekan dan semua bahan. Ulek cabai rawit dan bawang putih bersamaan. Tambahkan gula pasir, kacang panjang, dan tomat. Aduk perlahan hingga rata. Peras lemon dan aduk rata airnya bersama kecap ikan. Tambahkan irisan pepaya, wortel, ebi, dan kacang ke dalam campuran air lemon dan kecap ikan. Aduk hingga rata. Tunggu hingga bumbu meresap ke dalam pepaya dan wortel. Setelah itu, hidangkan.",
                'type' => 'breakfast',
                'calorie' => 73,
                'created_at' => $curr,
                'updated_at' => $curr
            ),
        );

        $this->ingredients = array(
            array(
                'ingredient' => ''
            ),
        );

    }
}