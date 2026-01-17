<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Feedback;
use App\Models\Pengguna;
use Illuminate\Support\Facades\DB;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Daftar review positif dalam bahasa Indonesia
        $positiveReviews = [
            "Sangat puas dengan fasilitas gym ini! Peralatan lengkap dan terawat dengan baik. Instruktur sangat profesional dan membantu dalam menyusun program latihan. Kebersihan tempat juga terjaga dengan baik, selalu wangi dan rapi. Harga membership sangat worth it untuk fasilitas yang diberikan. Recommended banget buat yang serius mau fitness!",

            "Pengalaman luar biasa! Sebagai pemula, saya awalnya takut masuk gym. Tapi staf di sini sangat ramah dan membantu. Mereka menjelaskan setiap alat dengan detail dan memberikan panduan yang aman. Dalam 3 bulan pertama, saya sudah merasakan progress yang signifikan. Suasana gym juga nyaman tidak terlalu ramai di jam yang saya datangi.",

            "Gym terbaik di kota ini! Equipmentnya updated dan variatif. Saya suka ada banyak pilihan untuk latihan kardio dan strength training. AC bekerja dengan optimal jadi tidak gerah meskipun latihan intens. Loker aman dan shower bersih. Management responsive terhadap feedback member. Keep up the good work!",

            "Sudah 1 tahun menjadi member dan tidak pernah menyesal. Progress fisik saya sangat terlihat, dari yang awalnya overweight sekarang sudah ideal. Program latihan dari personal trainer sangat efektif dan disesuaikan dengan kondisi tubuh saya. Harga personal training juga reasonable dibandingkan hasil yang didapat.",

            "Fasilitas lengkap dan modern! Dari treadmill, stationary bike, sampai alat-alat strength training terbaru semua ada. Tempatnya luas jadi tidak berdesakan meski di peak hour. Staf selalu siap membantu jika ada kesulitan. Free wifi juga kencang jadi bisa sambil dengerin musik atau nonton tutorial workout.",

            "Kebersihan menjadi prioritas utama di gym ini. Setiap alat selalu dibersihkan secara rutin, tersedia hand sanitizer di setiap sudut, dan lantai tidak licin. Ventilasi udara bagus sehingga tidak bau apek. Untuk harga segini, fasilitas yang diberikan sangat memuaskan. Will definitely renew my membership!",

            "Personal trainer di sini benar-benar kompeten! Mereka memiliki sertifikasi internasional dan pengalaman bertahun-tahun. Program latihan yang diberikan personalized sesuai goal masing-masing member. Saya yang punya masalah lutut mendapatkan program khusus yang aman dan efektif. Hasilnya luar biasa dalam 4 bulan!",

            "Atmosphere gymnya sangat supportive! Member-membernya friendly dan saling mendukung. Tidak ada yang judgmental terhadap newbie seperti saya. Musik tidak terlalu keras sehingga tetap bisa konsentrasi. Lighting juga pas, tidak terlalu terang tapi cukup untuk melihat dengan jelas. Overall experience 10/10!",

            "Parkiran luas dan aman, jadi tidak perlu khawatir dengan kendaraan. Jam operasional panjang dari jam 5 pagi sampai 11 malam, cocok untuk yang punya jadwal kerja tidak tetap. Ada juga kolam renang kecil untuk recovery setelah workout. Benar-benar one-stop fitness solution!",

            "Customer service excellent! Setiap ada kendala atau pertanyaan dijawab dengan cepat dan ramah. Proses pendaftaran mudah dan tidak berbelit-belit. Pembayaran bisa via berbagai metode digital. App untuk booking kelas juga user-friendly. Gym ini memang mengutamakan kenyamanan member."
        ];

        // Daftar review negatif dalam bahasa Indonesia
        $negativeReviews = [
            "Sangat kecewa dengan maintenance alat-alat di sini! Banyak alat yang rusak dan tidak diperbaiki berbulan-bulan. Treadmill sering error, dumbbell yang hilang tidak diganti, dan cable machine banyak yang kendur. Untuk harga membership premium, seharusnya maintenance lebih baik dari ini.",

            "Kebersihan sangat buruk! Lantai selalu licin karena keringat, bau tidak sedap di area shower, dan handuk yang disediakan kadang masih lembab. Saya beberapa kali melihat alat tidak dibersihkan setelah digunakan oleh member sebelumnya. Sangat tidak hygienic dan berpotensi menyebarkan penyakit.",

            "Overcrowded di jam sibuk! Antrian untuk menggunakan alat-alat populer bisa sampai 15-20 menit. Management tidak membatasi jumlah member yang masuk sehingga sangat tidak nyaman. Udara pengap karena AC tidak kuat menampung terlalu banyak orang. Lebih baik cari gym lain yang tidak terlalu padat.",

            "Staf tidak profesional! Instruktur lebih sering ngobrol dengan temannya daripada membantu member. Saat bertanya teknik yang benar, jawabannya asal-asalan. Receptionist juga sering tidak fokus karena main hp. Service seperti ini tidak pantas untuk gym dengan harga membership segini.",

            "Fasilitas tidak sesuai iklan! Di brosur disebutkan ada sauna dan steam room, ternyata sudah tidak berfungsi 6 bulan terakhir. Kolam renang sering keruh dan tidak dibersihkan rutin. Area free weights terlalu sempit sehingga berbahaya jika banyak orang. Feel cheated dengan promo yang diberikan.",

            "Harga naik terus tapi fasilitas tetap! Dalam setahun sudah 2 kali kenaikan harga tanpa penambahan fasilitas berarti. Bahkan beberapa kelas group dihapus dengan alasan efisiensi. Membership renewal dipaksa otomatis dengan syarat yang memberatkan. Tidak transparan dalam kebijakan harga.",

            "Alat-alat sudah tua dan usang! Banyak mesin yang berdecit, bantalan sudah tipis, dan beban tidak akurat. Safety jadi concern utama karena khawatir alat tiba-tiba rusak saat digunakan. Seharusnya ada budget rutin untuk upgrade equipment, bukan hanya menarik member baru terus.",

            "Parkiran sangat sempit dan berbahaya! Sudah beberapa kali ada gesekan antar mobil karena jalannya terlalu sempit. Tidak ada security yang mengatur lalu lintas. Motor parkir sembarangan menghalangi jalan. Management tidak peduli dengan keluhan ini dan tidak ada perbaikan sama sekali.",

            "AC sering mati di jam sibuk! Bayangkan gym penuh orang tanpa AC yang berfungsi. Udara panas dan pengap, sangat tidak nyaman dan berbahaya untuk kesehatan. Complaint berkali-kali hanya dijanjikan perbaikan tapi tidak pernah terealisasi. Sangat menguji kesabaran member.",

            "Personal trainer terlalu agresive menjual paket! Setiap kali datang selalu ditawari paket training dengan harga selangit. Bahkan sampai mengganggu saat sedang fokus workout. Teknik sales yang pushy dan membuat tidak nyaman. Sepertinya mereka lebih fokus pada komisi daripada membantu member."
        ];

        // Daftar review netral/campuran
        $neutralReviews = [
            "Fasilitas cukup lengkap tapi maintenance perlu ditingkatkan. Beberapa alat masih bagus, beberapa sudah mulai rusak. Staf cukup ramah tapi tidak semuanya kompeten. Harga standard untuk fasilitas yang diberikan. Cocok untuk yang tidak terlalu demanding dengan equipment high-end.",

            "Lokasi strategis di pusat kota tapi parkiran terbatas. Gymnya luas tapi layout kurang optimal sehingga terasa sempit di beberapa area. Kelas group cukup variatif tapi jadwal terbatas. Overall acceptable untuk harga mid-range, tapi jangan expect terlalu banyak.",

            "Peralatan basic ada semua tapi kurang variasi untuk advanced training. Baik untuk pemula atau intermediate lifter. Kebersihan cukup terjaga di area utama tapi di sudut-sudut masih kurang. Management responsive untuk complaint besar tapi hal kecil sering diabaikan.",

            "Suasana gym biasa saja, tidak terlalu ramai tapi juga tidak sepi. Music selection kurang bagus, kadang terlalu keras kadang terlalu pelan. Member mix antara yang serius dan yang casual. Cocok untuk yang ingin workout tanpa tekanan sosial yang berlebihan.",

            "Harga terjangkau dengan fasilitas standar. Jangan bandingkan dengan gym premium karena jelas berbeda kelas. Untuk maintenance tubuh dasar cukup memadai. Instruktur tersedia tapi perlu aktif bertanya karena mereka tidak akan approach duluan.",
        ];

        // Ambil semua pengguna
        $penggunas = Pengguna::all();
        
        // Jika belum ada pengguna, jalankan seeder pengguna dulu
        if ($penggunas->isEmpty()) {
            $this->command->info('Pengguna masih kosong. Jalankan PenggunaSeeder terlebih dahulu.');
            $this->call(PenggunaSeeder::class);
            $penggunas = Pengguna::all();
        }

        $feedbackData = [];
        $totalPengguna = count($penggunas);
        
        // Atur persentase feedback
        // 70% pengguna memberikan feedback (350 dari 500)
        $jumlahMemberiFeedback = 350;
        
        // Random pilih pengguna yang akan memberi feedback
        $penggunaIds = $penggunas->pluck('id')->toArray();
        shuffle($penggunaIds);
        $selectedPenggunaIds = array_slice($penggunaIds, 0, $jumlahMemberiFeedback);
        
        // Distribusi rating
        $ratingDistribution = [
            5 => 0.40, // 40% rating 5
            4 => 0.30, // 30% rating 4
            3 => 0.15, // 15% rating 3
            2 => 0.10, // 10% rating 2
            1 => 0.05, // 5% rating 1
        ];
        
        $i = 0;
        foreach ($selectedPenggunaIds as $penggunaId) {
            // Tentukan rating berdasarkan distribusi
            $rand = mt_rand() / mt_getrandmax();
            $cumulative = 0;
            $rating = 3; // default
            
            foreach ($ratingDistribution as $rt => $prob) {
                $cumulative += $prob;
                if ($rand <= $cumulative) {
                    $rating = $rt;
                    break;
                }
            }
            
            // Pilih review berdasarkan rating
            if ($rating >= 4) {
                // Rating 4-5: review positif
                $review = $positiveReviews[array_rand($positiveReviews)];
                
                // Tambah variasi untuk rating 4 vs 5
                if ($rating == 4) {
                    // Untuk rating 4, tambahkan sedikit kritik kecil
                    $kritikKecil = [
                        " Meskipun begitu, area parkir bisa diperluas lagi.",
                        " Hanya saja, kadang antrian di jam sibuk agak panjang.",
                        " Saran saya, tambah lagi alat untuk leg training.",
                        " Kekurangannya hanya di jaringan wifi yang kadang lemot.",
                        " Perlu improvement di sistem booking kelas online."
                    ];
                    $review .= $kritikKecil[array_rand($kritikKecil)];
                }
            } elseif ($rating == 3) {
                // Rating 3: review netral/campuran
                $review = $neutralReviews[array_rand($neutralReviews)];
            } else {
                // Rating 1-2: review negatif
                $review = $negativeReviews[array_rand($negativeReviews)];
                
                // Untuk rating 1, buat lebih negatif
                if ($rating == 1) {
                    $tambahanNegatif = [
                        " Sangat tidak direkomendasikan! Uang saya terbuang percuma.",
                        " Management benar-benar tidak profesional dalam menangani komplain.",
                        " Ini pengalaman gym terburuk yang pernah saya alami.",
                        " Saya sudah memutuskan untuk pindah gym dan tidak akan kembali.",
                        " Health hazard! Beberapa alat berjamur dan berdebu tebal."
                    ];
                    $review .= $tambahanNegatif[array_rand($tambahanNegatif)];
                }
            }
            
            // Tambahkan variasi personal pada review
            $personalTouch = [
                " Sebagai member yang sudah bergabung " . rand(1, 24) . " bulan, saya merasa...",
                " Dibandingkan dengan gym sebelumnya, menurut saya...",
                " Untuk harga Rp " . number_format(rand(300000, 800000), 0, ',', '.') . " per bulan...",
                " Sebagai " . (rand(0, 1) ? "pemula" : "atlet amatir") . ", pengalaman saya...",
                " Dengan tujuan " . (rand(0, 1) ? "weight loss" : "muscle building") . " saya..."
            ];
            
            // Sisipkan personal touch di tengah atau akhir secara random
            if (rand(0, 1)) {
                $pos = strpos($review, '.');
                if ($pos !== false) {
                    $review = substr_replace($review, $personalTouch[array_rand($personalTouch)], $pos + 1, 0);
                }
            }
            
            $feedbackData[] = [
                'id_pengguna' => $penggunaId,
                'rating' => $rating,
                'review' => $review,
                'created_at' => now()->subDays(rand(0, 180))->addHours(rand(0, 23))->addMinutes(rand(0, 59)),
                'updated_at' => now(),
            ];
            
            $i++;
            
            if ($i % 100 == 0 || $i == $jumlahMemberiFeedback) {
                Feedback::insert($feedbackData);
                $feedbackData = [];
                $this->command->info("Memasukkan {$i} feedback...");
            }
        }
        
        $this->command->info("Berhasil memasukkan {$jumlahMemberiFeedback} feedback dari {$totalPengguna} pengguna.");
    }
}