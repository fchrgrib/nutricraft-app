<?php

namespace di;

class InitialData
{
    private $file;
    private $ingredients;
    private $meals;
    private $content;
    private $nutritionFact;

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
                'title' => 'Manfaat Berolahraga Untuk Tubuh',
                'id_file' => 3,
                'id_photo_highlight' => 2,
                'body' =>"Berolahraga memiliki banyak manfaat positif bagi kesehatan fisik dan mental. Pertama, berolahraga secara teratur dapat membantu menjaga berat badan yang sehat atau mencapai berat badan yang diinginkan. Dengan membakar kalori dan meningkatkan metabolisme, olahraga membantu mengurangi risiko obesitas, yang merupakan faktor risiko utama untuk berbagai penyakit seperti diabetes tipe 2, penyakit jantung, dan beberapa jenis kanker.\n\n
                          Selain itu, berolahraga juga dapat memperkuat otot dan tulang, meningkatkan fleksibilitas, serta menjaga kesehatan persendian. Ini penting untuk menjaga mobilitas dan mengurangi risiko cedera. Selain manfaat fisik, berolahraga juga memiliki dampak positif pada kesehatan mental. Aktivitas fisik dapat merangsang pelepasan endorfin, yang dapat meningkatkan suasana hati dan mengurangi stres serta kecemasan.\n\n
                          Selain itu, berolahraga juga dapat meningkatkan kualitas tidur dan membantu mengatasi masalah tidur seperti insomnia. Aktivitas fisik yang teratur juga dapat meningkatkan daya kognitif, memperbaiki fokus, dan meningkatkan produktivitas. Terakhir, berolahraga bersifat sosial, memungkinkan individu untuk terlibat dalam aktivitas bersama teman-teman atau komunitas, yang dapat meningkatkan aspek sosial dan emosional kesejahteraan. Dengan demikian, berolahraga bukan hanya cara untuk menjaga tubuh sehat, tetapi juga kunci untuk hidup sehat secara menyeluruh.",
                'highlight' => 'Berolahraga sangat baik untuk tubuh. Kami meringkas 5 manfaat dari berolahraga',
                'created_at' => $curr,
                'updated_at' =>$curr
            ),
            array(
                'title' => 'Bahayanya Obesitas',
                'id_file' => 5,
                'id_photo_highlight' => 4,
                'body' =>"Obesitas adalah masalah kesehatan serius yang dapat memiliki dampak yang merugikan pada individu dan masyarakat secara luas. Pertama, obesitas meningkatkan risiko berbagai penyakit kronis seperti diabetes tipe 2, penyakit jantung, stroke, dan beberapa jenis kanker. Kondisi ini juga dapat mengakibatkan gangguan pernapasan, termasuk sleep apnea, yang bisa mengganggu kualitas tidur seseorang dan mengarah pada kelelahan kronis. Obesitas juga dapat memengaruhi kesehatan mental seseorang dengan meningkatkan risiko depresi dan kecemasan karena stigma sosial yang sering terkait dengan kondisi ini.\n\n
                          Kedua, obesitas dapat menghasilkan beban finansial yang besar pada sistem perawatan kesehatan. Biaya perawatan medis yang tinggi yang diperlukan untuk mengatasi komplikasi yang terkait dengan obesitas, seperti operasi bariatrik dan pengobatan jangka panjang, dapat merugikan sistem kesehatan dan menguras sumber daya ekonomi. Selain itu, absensi kerja yang lebih tinggi dan produktivitas yang berkurang akibat masalah kesehatan yang terkait dengan obesitas juga berdampak pada perekonomian secara keseluruhan. Oleh karena itu, obesitas bukan hanya masalah individu, tetapi juga merupakan ancaman serius bagi kesejahteraan masyarakat secara keseluruhan, dan upaya pencegahan serta pengelolaan yang efektif perlu ditingkatkan untuk mengurangi bahaya yang terkait dengan obesitas.",
                'highlight' => 'Obesitas dapat meningkatkan risiko serius seperti diabetes, penyakit jantung, dan kanker. Ini juga dapat mengurangi kualitas hidup dan menimbulkan beban ekonomi yang besar pada sistem kesehatan. Pencegahan obesitas sangat penting untuk menjaga kesehatan individu dan masyarakat.',
                'created_at' => $curr,
                'updated_at' =>$curr
            ),
            array(
                'title' => 'Manfaat Perilaku Hidup Sehat',
                'id_file' => 7,
                'id_photo_highlight' => 6,
                'body' =>"Perilaku hidup sehat adalah pilihan gaya hidup yang berfokus pada keputusan dan tindakan yang mendukung kesehatan fisik dan mental yang optimal. Ini mencakup berbagai aspek, termasuk pola makan seimbang, berolahraga secara teratur, tidur yang cukup, menghindari kebiasaan merokok dan konsumsi alkohol yang berlebihan, serta mengelola stres dengan baik. Berikut adalah beberapa manfaat dari mengadopsi perilaku hidup sehat:\n\n
                          Meningkatkan Kesehatan Fisik: Perilaku hidup sehat dapat membantu mencegah berbagai penyakit kronis, seperti diabetes, penyakit jantung, dan beberapa jenis kanker. Pola makan seimbang dan olahraga yang teratur mendukung berat badan yang sehat, memperkuat sistem kekebalan tubuh, dan menjaga fungsi organ-organ vital seperti jantung, paru-paru, dan ginjal.\n\n
                          Meningkatkan Kualitas Hidup: Memelihara perilaku hidup sehat dapat meningkatkan kualitas hidup secara keseluruhan. Tubuh yang sehat dan bugar memungkinkan individu untuk melakukan aktivitas sehari-hari dengan lebih baik, mengatasi tantangan fisik, dan menikmati hidup tanpa batasan fisik yang serius.\n\n
                          Mengurangi Risiko Kematian Dini: Menerapkan perilaku hidup sehat dapat membantu mengurangi risiko kematian dini. Menghindari kebiasaan berbahaya seperti merokok dan minum alkohol secara berlebihan dapat memperpanjang umur seseorang, sedangkan menjaga berat badan yang sehat dan mengatur tekanan darah serta kadar kolesterol dapat mengurangi risiko penyakit yang mengancam jiwa.\n\n
                          Menjaga Kesehatan Mental: Kesehatan mental yang baik juga merupakan bagian penting dari perilaku hidup sehat. Tidur yang cukup, mengelola stres, dan menjaga hubungan sosial yang baik dapat membantu mengurangi risiko gangguan mental seperti depresi dan kecemasan, serta meningkatkan kesejahteraan emosional secara keseluruhan.\n\n
                          Menghemat Biaya Kesehatan: Mengadopsi perilaku hidup sehat dapat menghemat biaya perawatan kesehatan jangka panjang. Dengan mencegah penyakit kronis dan masalah kesehatan yang dapat dicegah, individu dapat mengurangi pengeluaran medis dan beban finansial yang terkait dengan perawatan jangka panjang.\n\n
                          \n
                          Dengan menerapkan perilaku hidup sehat, individu dapat merasakan manfaat yang signifikan dalam kesehatan fisik dan mental mereka, serta meningkatkan harapan hidup mereka. Selain itu, perilaku hidup sehat juga memiliki dampak positif pada masyarakat secara keseluruhan, dengan potensi untuk mengurangi beban sistem perawatan kesehatan dan menciptakan lingkungan yang lebih sehat bagi semua orang.",
                'highlight' => 'Manfaat perilaku hidup sehat meliputi peningkatan kesehatan fisik dan mental, mengurangi risiko penyakit kronis, dan meningkatkan kualitas hidup secara keseluruhan. Dengan mengadopsi pola makan seimbang, berolahraga teratur, dan menghindari kebiasaan berbahaya, individu dapat memperpanjang umur dan menghemat biaya perawatan kesehatan jangka panjang. Perilaku hidup sehat juga berkontribusi pada kesejahteraan sosial dan ekonomi masyarakat secara keseluruhan.',
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
                'type' => 'Breakfast',
                'calorie' => 70,
                'id_file' =>9,
                'created_at' => $curr,
                'updated_at' => $curr
            ),
            array(
                'title' => 'Resep Caesar Salad',
                'highlight' => 'Caesar salad adalah olahan salad sayur yang sangat populer. Jangan kira resep makanan ini ditemukan saat Julius Caesar berkuasa. Nama caesar salad diambil dari Caesar Cardini, chef dan pengusaha restoran yang menemukan racikannya.',
                'description' => "Cara Membuat Crouton:\n\n
                                  Oles tipis-tipis permukaan roti dengan margarin, kemudian potong dadu.Panaskan minyak goreng, kemudian tumis bawang putih hingga harum. Masukkan potongan roti, lalu aduk rata hingga berwarna agak kecokelatan. Setelah itu angkat crouton dan sisihkan terlebih dahulu.Cara Membuat Salad Dressing:Kocok kuning telur hingga berwarna pucat. Tuang minyak zaitun sedikit demi sedikit sambil terus diaduk hingga kental.Tuangkan air lemon, garam, merica, gula pasir, capers, dan anchovy. Aduk rata, kemudian sisihkan terlebih dahulu.Penyajian:Aduk romaine lettuce dengan saus secukupnya saja.Taburi crouton, daging asap, dan telur rebus. Setelah itu taburi dengan keju parmesan parut.Sajikan caesar salad selagi romain lettuce masih segar dan renyah.",
                'type' => 'Breakfast',
                'calorie' => 77,
                'id_file' =>8,
                'created_at' => $curr,
                'updated_at' => $curr
            ),
            array(
                'title' => 'Resep Salad Roll (Vietnamese Summer Roll)',
                'highlight' => 'Salah satu jenis lumpia yang berasal dari Vietnam adalah goi cuon. Lumpia yang di barat disebut summer rolls ini disajikan dengan sayur-sayuran mentah, bihun tawar, timun, selada, mint, daging babi kukus, dan udang rebus.',
                'description' => "Cara Membuat Summer Roll Vietnam:\n\n
                                  Rebus atau rendam soun dalam air panas sampai lunak. Kemudian tiriskan airnya dan tuangi sedikit minyak wijen agar tidak menggumpal. Iris memanjang timun dan lettuce. Avokad dan bawang perai diiris tipis dengan potongan menyerong. Kacang tanah digerus kasar. Rebus udang yang sudah dikupas dan dibuang ekor serta kepalanya selama 1-2 menit. Kemudian tiriskan airnya dan rendam dalam larutan air, cuka, garam, dan arak masak. Setelah itu belah menjadi 2 bagian dan sisihkan. Rebus paha ayam di dalam air yang sudah dibubuhi garam. Setelah itu iris-iris seukuran satu suapan. Basahi rice paper dengan air panas agar lunak. Jangan sampai berkerut dan menempel. Ambil 2 lembar rice paper, kemudian tumpuk agar summer rolls tidak mudah sobek. Alasi dengan perilla, kemudian letakkan lettuce, avokad, ayam, soun, bawang perai, dan timun di satu sisi. Taburi kacang tanah,kemudian gulung rapi seperti amplop. Sebelum 2 gulungan terakhir, letakkan udang yang sudah dibelah 2 dengan sisi luar menghadap bawah.
                                  Sajikan summer rolls dalam keadaan utuh atau dipotong-potong dengan saus asam manis.",
                'type' => 'Breakfast',
                'calorie' => 74,
                'id_file' =>10,
                'created_at' => $curr,
                'updated_at' => $curr
            ),
            array(
                'title' => 'Resep Salad Pepaya Muda Thailand (Som Tum)',
                'highlight' => 'Som tum adalah salad pepaya muda dari Thailand. Rasanya asam, manis, gurih, dan pedas. Segarnya bumbu dengan citarasa asam, kecap ikan, dan kacang tanah membuat rasanya semakin istimewa.',
                'description' => "Cara Membuat Som Tum:\n\n
                                  Siapkan ulekan dan semua bahan. Ulek cabai rawit dan bawang putih bersamaan. Tambahkan gula pasir, kacang panjang, dan tomat. Aduk perlahan hingga rata. Peras lemon dan aduk rata airnya bersama kecap ikan. Tambahkan irisan pepaya, wortel, ebi, dan kacang ke dalam campuran air lemon dan kecap ikan. Aduk hingga rata. Tunggu hingga bumbu meresap ke dalam pepaya dan wortel. Setelah itu, hidangkan.",
                'type' => 'Breakfast',
                'calorie' => 73,
                'id_file' =>11,
                'created_at' => $curr,
                'updated_at' => $curr
            ),
        );

        $this->ingredients = array(
            array(
                'ingredient' => 'jagung manis',
                'description' => '1 batang',
                'id_meals' =>1
            ),
            array(
                'ingredient' => 'head lettuce',
                'description' => '6 lembar',
                'id_meals' =>1
            ),
            array(
                'ingredient' => 'brokoli sobek',
                'description' => '100 gram',
                'id_meals' =>1
            ),
            array(
                'ingredient' => 'paprik merah/paprika kuning',
                'description' => '1 buah',
                'id_meals' =>1
            ),
            array(
                'ingredient' => 'timun jepang',
                'description' => '1 buah',
                'id_meals' =>1
            ),
            array(
                'ingredient' => 'mayones',
                'description' => '150 gram',
                'id_meals' =>1
            ),
            array(
                'ingredient' => 'bawang putih',
                'description' => '1 siung',
                'id_meals' =>1
            ),
            array(
                'ingredient' => 'yoghurt',
                'description' => '50 gram',
                'id_meals' =>1
            ),
            array(
                'ingredient' => 'romaine',
                'description' => '300 gram',
                'id_meals' =>2
            ),
            array(
                'ingredient' => 'keju parmesan',
                'description' => '3 buah',
                'id_meals' =>2
            ),
            array(
                'ingredient' => 'daging asap',
                'description' => '2 lembar',
                'id_meals' =>2
            ),
            array(
                'ingredient' => 'telur',
                'description' => '2 butir',
                'id_meals' =>2
            ),
            array(
                'ingredient' => 'minyak zaitun',
                'description' => '100 ml',
                'id_meals' =>2
            ),
            array(
                'ingredient' => 'perasan lemon',
                'description' => '2 sendok makan',
                'id_meals' =>2
            ),
            array(
                'ingredient' => 'vietnam rice paper',
                'description' => '20 lembar',
                'id_meals' =>3
            ),
            array(
                'ingredient' => 'soun',
                'description' => '15 gram',
                'id_meals' =>3
            ),
            array(
                'ingredient' => 'lettuce',
                'description' => '4 lembar',
                'id_meals' =>3
            ),
            array(
                'ingredient' => 'udang',
                'description' => '10 ekor',
                'id_meals' =>3
            ),
            array(
                'ingredient' => 'paha ayam',
                'description' => '1 potong',
                'id_meals' =>3
            ),
        );


        $this->nutritionFact = array();
        $calorie = array(70,77,74,73);

        for ($i = 0; $i < 4; $i++) {
            $subArray = array(
                'calorie' => $calorie[$i] . ' cal',
                'carbo' => rand(10, 30) . 'g',
                'protein' => rand(40, 80) . 'g',
                'fat' => rand(0, 5) . 'g',
                'sugar' => rand(0, 10) . 'g',
                'id_meals' => $i+1
            );

            $this->nutritionFact[] = $subArray;
        }

    }


    public function getContent()
    {
        return $this->content;
    }


    public function getFile()
    {
        return $this->file;
    }


    public function getIngredients()
    {
        return $this->ingredients;
    }


    public function getMeals()
    {
        return $this->meals;
    }


    public function getNutritionFact()
    {
        return $this->nutritionFact;
    }
}