<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JadwalWorkout;
use App\Models\Workout;
use Carbon\Carbon;

class WorkoutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $workoutData = [
            [
                'jadwal' => [
                    'nama_jadwal' => 'Full Body Strength',
                    'kategori_jadwal' => 'Strength Training',
                    'tanggal' => Carbon::today()->addDays(1)->format('Y-m-d'),
                    'jam' => '07:00',
                    'durasi_workout' => '60 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Full Body Compound Lifts',
                    'deskripsi' => 'Latihan seluruh tubuh dengan fokus pada compound movements untuk membangun kekuatan dan massa otot.',
                    'equipment' => 'Barbell, Dumbbells, Bench, Squat Rack',
                    'kategori' => 'With Equipment',
                    'exercises' => 6,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'HIIT Cardio',
                    'kategori_jadwal' => 'Cardio',
                    'tanggal' => Carbon::today()->addDays(1)->format('Y-m-d'),
                    'jam' => '17:30',
                    'durasi_workout' => '45 menit',
                ],
                'workout' => [
                    'nama_workout' => 'High Intensity Interval Training',
                    'deskripsi' => 'Latihan kardio intensitas tinggi dengan interval untuk membakar kalori dan meningkatkan metabolisme.',
                    'equipment' => 'Treadmill, Stationary Bike, Jump Rope',
                    'kategori' => 'With Equipment',
                    'exercises' => 8,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Upper Body Focus',
                    'kategori_jadwal' => 'Muscle Building',
                    'tanggal' => Carbon::today()->addDays(2)->format('Y-m-d'),
                    'jam' => '08:00',
                    'durasi_workout' => '75 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Chest, Shoulders & Triceps',
                    'deskripsi' => 'Latihan fokus pada bagian atas tubuh termasuk dada, bahu, dan trisep.',
                    'equipment' => 'Bench Press Machine, Dumbbells, Cable Machine',
                    'kategori' => 'With Equipment',
                    'exercises' => 7,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Yoga Morning',
                    'kategori_jadwal' => 'Flexibility',
                    'tanggal' => Carbon::today()->addDays(2)->format('Y-m-d'),
                    'jam' => '06:30',
                    'durasi_workout' => '60 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Vinyasa Flow Yoga',
                    'deskripsi' => 'Sesi yoga untuk meningkatkan fleksibilitas, keseimbangan, dan relaksasi mental.',
                    'equipment' => 'Yoga Mat, Blocks, Strap',
                    'kategori' => 'With Equipment',
                    'exercises' => 12,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Leg Day Intensive',
                    'kategori_jadwal' => 'Lower Body',
                    'tanggal' => Carbon::today()->addDays(3)->format('Y-m-d'),
                    'jam' => '09:00',
                    'durasi_workout' => '80 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Quad & Hamstring Focus',
                    'deskripsi' => 'Latihan intensif untuk kaki fokus pada paha depan dan belakang.',
                    'equipment' => 'Leg Press, Squat Rack, Leg Curl Machine',
                    'kategori' => 'With Equipment',
                    'exercises' => 8,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Bodyweight Challenge',
                    'kategori_jadwal' => 'Calisthenics',
                    'tanggal' => Carbon::today()->addDays(3)->format('Y-m-d'),
                    'jam' => '18:00',
                    'durasi_workout' => '50 menit',
                ],
                'workout' => [
                    'nama_workout' => 'No Equipment Full Body',
                    'deskripsi' => 'Latihan menggunakan berat badan sendiri tanpa alat untuk seluruh tubuh.',
                    'equipment' => 'Tidak ada',
                    'kategori' => 'Without Equipment',
                    'exercises' => 10,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Back & Biceps',
                    'kategori_jadwal' => 'Muscle Building',
                    'tanggal' => Carbon::today()->addDays(4)->format('Y-m-d'),
                    'jam' => '10:00',
                    'durasi_workout' => '70 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Pull Day Workout',
                    'deskripsi' => 'Latihan fokus pada otot punggung dan biceps dengan berbagai variasi pull exercises.',
                    'equipment' => 'Pull-up Bar, Lat Pulldown Machine, Dumbbells',
                    'kategori' => 'With Equipment',
                    'exercises' => 7,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Morning Run',
                    'kategori_jadwal' => 'Cardio',
                    'tanggal' => Carbon::today()->addDays(4)->format('Y-m-d'),
                    'jam' => '06:00',
                    'durasi_workout' => '40 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Outdoor Running Session',
                    'deskripsi' => 'Lari pagi di luar ruangan dengan interval untuk meningkatkan stamina.',
                    'equipment' => 'Running Shoes, Smartwatch',
                    'kategori' => 'With Equipment',
                    'exercises' => 5,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Core & Abs',
                    'kategori_jadwal' => 'Core Training',
                    'tanggal' => Carbon::today()->addDays(5)->format('Y-m-d'),
                    'jam' => '07:30',
                    'durasi_workout' => '45 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Abdominal Strengthening',
                    'deskripsi' => 'Latihan khusus untuk menguatkan otot perut dan core stability.',
                    'equipment' => 'Exercise Mat, Medicine Ball, Ab Roller',
                    'kategori' => 'With Equipment',
                    'exercises' => 15,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Circuit Training',
                    'kategori_jadwal' => 'Mixed',
                    'tanggal' => Carbon::today()->addDays(5)->format('Y-m-d'),
                    'jam' => '17:00',
                    'durasi_workout' => '55 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Total Body Circuit',
                    'deskripsi' => 'Latihan circuit training yang menggabungkan strength dan cardio.',
                    'equipment' => 'Kettlebells, Battle Ropes, Plyo Box',
                    'kategori' => 'With Equipment',
                    'exercises' => 9,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Push Day',
                    'kategori_jadwal' => 'Strength Training',
                    'tanggal' => Carbon::today()->addDays(6)->format('Y-m-d'),
                    'jam' => '08:30',
                    'durasi_workout' => '65 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Chest, Shoulders & Triceps Push',
                    'deskripsi' => 'Latihan push movements untuk dada, bahu, dan trisep.',
                    'equipment' => 'Barbell, Bench, Shoulder Press Machine',
                    'kategori' => 'With Equipment',
                    'exercises' => 6,
                    'status' => 'sedang dilakukan',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Pilates Session',
                    'kategori_jadwal' => 'Flexibility',
                    'tanggal' => Carbon::today()->addDays(6)->format('Y-m-d'),
                    'jam' => '09:30',
                    'durasi_workout' => '50 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Reformer Pilates',
                    'deskripsi' => 'Latihan pilates dengan reformer machine untuk postur dan core strength.',
                    'equipment' => 'Pilates Reformer, Mat, Rings',
                    'kategori' => 'With Equipment',
                    'exercises' => 14,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Glutes & Hamstrings',
                    'kategori_jadwal' => 'Lower Body',
                    'tanggal' => Carbon::today()->addDays(7)->format('Y-m-d'),
                    'jam' => '10:30',
                    'durasi_workout' => '70 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Posterior Chain Workout',
                    'deskripsi' => 'Latihan fokus pada glutes dan hamstrings untuk kekuatan bagian belakang tubuh.',
                    'equipment' => 'Hip Thrust Bench, Glute Machine, Resistance Bands',
                    'kategori' => 'With Equipment',
                    'exercises' => 8,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Swimming Cardio',
                    'kategori_jadwal' => 'Cardio',
                    'tanggal' => Carbon::today()->addDays(7)->format('Y-m-d'),
                    'jam' => '16:00',
                    'durasi_workout' => '60 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Pool Swimming Workout',
                    'deskripsi' => 'Latihan berenang dengan berbagai stroke untuk kardio rendah dampak.',
                    'equipment' => 'Swimsuit, Goggles, Swim Cap',
                    'kategori' => 'With Equipment',
                    'exercises' => 7,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Mobility & Stretching',
                    'kategori_jadwal' => 'Recovery',
                    'tanggal' => Carbon::today()->addDays(8)->format('Y-m-d'),
                    'jam' => '19:00',
                    'durasi_workout' => '40 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Active Recovery Session',
                    'deskripsi' => 'Latihan mobility dan stretching untuk pemulihan dan pencegahan cedera.',
                    'equipment' => 'Foam Roller, Stretching Strap, Mat',
                    'kategori' => 'With Equipment',
                    'exercises' => 12,
                    'status' => 'selesai',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'CrossFit WOD',
                    'kategori_jadwal' => 'High Intensity',
                    'tanggal' => Carbon::today()->addDays(8)->format('Y-m-d'),
                    'jam' => '06:30',
                    'durasi_workout' => '60 menit',
                ],
                'workout' => [
                    'nama_workout' => 'CrossFit Workout of the Day',
                    'deskripsi' => 'Workout of the Day (WOD) CrossFit dengan variasi functional movements.',
                    'equipment' => 'Olympic Barbell, Pull-up Rig, Wall Ball',
                    'kategori' => 'With Equipment',
                    'exercises' => 10,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Arms Specialization',
                    'kategori_jadwal' => 'Muscle Building',
                    'tanggal' => Carbon::today()->addDays(9)->format('Y-m-d'),
                    'jam' => '11:00',
                    'durasi_workout' => '60 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Biceps & Triceps Focus',
                    'deskripsi' => 'Latihan khusus untuk pengembangan otot lengan (biceps dan triceps).',
                    'equipment' => 'EZ Bar, Cable Machine, Preacher Curl Bench',
                    'kategori' => 'With Equipment',
                    'exercises' => 9,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Boxing Training',
                    'kategori_jadwal' => 'Martial Arts',
                    'tanggal' => Carbon::today()->addDays(9)->format('Y-m-d'),
                    'jam' => '17:30',
                    'durasi_workout' => '75 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Boxing Skills & Conditioning',
                    'deskripsi' => 'Latihan teknik tinju dikombinasikan dengan conditioning workout.',
                    'equipment' => 'Boxing Gloves, Heavy Bag, Speed Bag',
                    'kategori' => 'With Equipment',
                    'exercises' => 11,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Home Workout',
                    'kategori_jadwal' => 'Home Fitness',
                    'tanggal' => Carbon::today()->addDays(10)->format('Y-m-d'),
                    'jam' => '07:00',
                    'durasi_workout' => '45 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Minimal Equipment Home Routine',
                    'deskripsi' => 'Rutinitas latihan di rumah dengan peralatan minimal.',
                    'equipment' => 'Resistance Bands, Dumbbells, Mat',
                    'kategori' => 'With Equipment',
                    'exercises' => 8,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Spin Class',
                    'kategori_jadwal' => 'Cardio',
                    'tanggal' => Carbon::today()->addDays(10)->format('Y-m-d'),
                    'jam' => '18:30',
                    'durasi_workout' => '50 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Indoor Cycling Session',
                    'deskripsi' => 'Kelas spinning dengan musik untuk kardio intensitas tinggi.',
                    'equipment' => 'Spin Bike, Cycling Shoes, Towel',
                    'kategori' => 'With Equipment',
                    'exercises' => 6,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Deadlift Day',
                    'kategori_jadwal' => 'Powerlifting',
                    'tanggal' => Carbon::today()->addDays(11)->format('Y-m-d'),
                    'jam' => '09:00',
                    'durasi_workout' => '80 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Deadlift & Back Accessories',
                    'deskripsi' => 'Sesi latihan fokus pada deadlift dengan accessory exercises untuk punggung.',
                    'equipment' => 'Barbell, Plates, Lifting Straps',
                    'kategori' => 'With Equipment',
                    'exercises' => 7,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Functional Training',
                    'kategori_jadwal' => 'Functional',
                    'tanggal' => Carbon::today()->addDays(11)->format('Y-m-d'),
                    'jam' => '16:00',
                    'durasi_workout' => '55 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Everyday Movement Patterns',
                    'deskripsi' => 'Latihan functional movements yang berguna untuk aktivitas sehari-hari.',
                    'equipment' => 'Kettlebells, Sandbags, TRX',
                    'kategori' => 'With Equipment',
                    'exercises' => 9,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Shoulder Sculpting',
                    'kategori_jadwal' => 'Muscle Building',
                    'tanggal' => Carbon::today()->addDays(12)->format('Y-m-d'),
                    'jam' => '08:30',
                    'durasi_workout' => '60 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Deltoid Development',
                    'deskripsi' => 'Latihan khusus untuk membangun otot bahu yang simetris.',
                    'equipment' => 'Dumbbells, Cable Machine, Shoulder Press',
                    'kategori' => 'With Equipment',
                    'exercises' => 8,
                    'status' => 'selesai',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Trail Running',
                    'kategori_jadwal' => 'Outdoor',
                    'tanggal' => Carbon::today()->addDays(12)->format('Y-m-d'),
                    'jam' => '06:30',
                    'durasi_workout' => '90 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Mountain Trail Run',
                    'deskripsi' => 'Lari trail di alam dengan medan naik turun untuk tantangan ekstra.',
                    'equipment' => 'Trail Running Shoes, Hydration Pack',
                    'kategori' => 'With Equipment',
                    'exercises' => 5,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Tabata Training',
                    'kategori_jadwal' => 'HIIT',
                    'tanggal' => Carbon::today()->addDays(13)->format('Y-m-d'),
                    'jam' => '07:30',
                    'durasi_workout' => '30 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Tabata Protocol Workout',
                    'deskripsi' => 'Latihan Tabata (20 detik kerja, 10 detik istirahat) untuk pembakaran kalori maksimal.',
                    'equipment' => 'Timer, Mat, Jump Rope',
                    'kategori' => 'With Equipment',
                    'exercises' => 8,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Chest Building',
                    'kategori_jadwal' => 'Strength Training',
                    'tanggal' => Carbon::today()->addDays(13)->format('Y-m-d'),
                    'jam' => '17:00',
                    'durasi_workout' => '70 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Pec Development Routine',
                    'deskripsi' => 'Latihan khusus untuk pengembangan otot dada dengan variasi angle.',
                    'equipment' => 'Bench Press, Incline Bench, Chest Fly Machine',
                    'kategori' => 'With Equipment',
                    'exercises' => 7,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Barre Class',
                    'kategori_jadwal' => 'Dance Fitness',
                    'tanggal' => Carbon::today()->addDays(14)->format('Y-m-d'),
                    'jam' => '09:00',
                    'durasi_workout' => '55 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Ballet-Inspired Workout',
                    'deskripsi' => 'Latihan barre yang mengombinasikan ballet, pilates, dan yoga.',
                    'equipment' => 'Barre, Light Weights, Mat',
                    'kategori' => 'With Equipment',
                    'exercises' => 12,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Squat Day',
                    'kategori_jadwal' => 'Powerlifting',
                    'tanggal' => Carbon::today()->addDays(14)->format('Y-m-d'),
                    'jam' => '10:00',
                    'durasi_workout' => '75 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Barbell Squat Focus',
                    'deskripsi' => 'Sesi latihan berfokus pada barbell squat dengan variasi dan accessories.',
                    'equipment' => 'Squat Rack, Barbell, Weight Plates',
                    'kategori' => 'With Equipment',
                    'exercises' => 6,
                    'status' => 'sedang dilakukan',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Recovery Yoga',
                    'kategori_jadwal' => 'Recovery',
                    'tanggal' => Carbon::today()->addDays(15)->format('Y-m-d'),
                    'jam' => '19:30',
                    'durasi_workout' => '60 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Restorative Yoga Session',
                    'deskripsi' => 'Yoga pemulihan dengan pose-pose yang menenangkan dan regeneratif.',
                    'equipment' => 'Yoga Mat, Bolster, Blanket',
                    'kategori' => 'With Equipment',
                    'exercises' => 10,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Kettlebell Flow',
                    'kategori_jadwal' => 'Functional',
                    'tanggal' => Carbon::today()->addDays(15)->format('Y-m-d'),
                    'jam' => '08:00',
                    'durasi_workout' => '50 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Kettlebell Complexes',
                    'deskripsi' => 'Latihan kettlebell dengan complex movements untuk kekuatan dan kardio.',
                    'equipment' => 'Kettlebells (various weights)',
                    'kategori' => 'With Equipment',
                    'exercises' => 8,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Jump Rope Cardio',
                    'kategori_jadwal' => 'Cardio',
                    'tanggal' => Carbon::today()->addDays(16)->format('Y-m-d'),
                    'jam' => '07:00',
                    'durasi_workout' => '40 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Rope Skipping Workout',
                    'deskripsi' => 'Latihan skipping dengan berbagai variasi teknik untuk kardio efisien.',
                    'equipment' => 'Jump Rope, Timer',
                    'kategori' => 'With Equipment',
                    'exercises' => 7,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Lats & Traps',
                    'kategori_jadwal' => 'Back Training',
                    'tanggal' => Carbon::today()->addDays(16)->format('Y-m-d'),
                    'jam' => '16:30',
                    'durasi_workout' => '65 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Upper Back Development',
                    'deskripsi' => 'Latihan khusus untuk latissimus dorsi dan trapezius.',
                    'equipment' => 'Pull-up Bar, T-bar Row, Shrug Machine',
                    'kategori' => 'With Equipment',
                    'exercises' => 7,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Calisthenics Park',
                    'kategori_jadwal' => 'Bodyweight',
                    'tanggal' => Carbon::today()->addDays(17)->format('Y-m-d'),
                    'jam' => '07:30',
                    'durasi_workout' => '70 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Outdoor Calisthenics',
                    'deskripsi' => 'Latihan calisthenics di outdoor park dengan berbagai skill work.',
                    'equipment' => 'Pull-up Bars, Parallel Bars, Dip Station',
                    'kategori' => 'With Equipment',
                    'exercises' => 9,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Rowing Machine',
                    'kategori_jadwal' => 'Cardio',
                    'tanggal' => Carbon::today()->addDays(17)->format('Y-m-d'),
                    'jam' => '18:00',
                    'durasi_workout' => '45 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Ergometer Rowing Session',
                    'deskripsi' => 'Latihan menggunakan rowing machine untuk kardio full body.',
                    'equipment' => 'Rowing Machine (Concept2)',
                    'kategori' => 'With Equipment',
                    'exercises' => 6,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Forearm & Grip',
                    'kategori_jadwal' => 'Specialized',
                    'tanggal' => Carbon::today()->addDays(18)->format('Y-m-d'),
                    'jam' => '10:00',
                    'durasi_workout' => '40 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Grip Strength Training',
                    'deskripsi' => 'Latihan khusus untuk meningkatkan kekuatan genggaman dan lengan bawah.',
                    'equipment' => 'Fat Gripz, Captains of Crush, Wrist Roller',
                    'kategori' => 'With Equipment',
                    'exercises' => 8,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Meditation & Breathing',
                    'kategori_jadwal' => 'Mindfulness',
                    'tanggal' => Carbon::today()->addDays(18)->format('Y-m-d'),
                    'jam' => '20:00',
                    'durasi_workout' => '30 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Breathwork Practice',
                    'deskripsi' => 'Latihan pernapasan dan meditasi untuk mengurangi stress.',
                    'equipment' => 'Meditation Cushion, Timer',
                    'kategori' => 'Without Equipment',
                    'exercises' => 4,
                    'status' => 'selesai',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Bench Press Focus',
                    'kategori_jadwal' => 'Powerlifting',
                    'tanggal' => Carbon::today()->addDays(19)->format('Y-m-d'),
                    'jam' => '09:30',
                    'durasi_workout' => '75 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Bench Press & Accessories',
                    'deskripsi' => 'Sesi latihan berfokus pada bench press dengan accessory work.',
                    'equipment' => 'Bench Press Station, Barbell, Spotter',
                    'kategori' => 'With Equipment',
                    'exercises' => 6,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Zumba Party',
                    'kategori_jadwal' => 'Dance Fitness',
                    'tanggal' => Carbon::today()->addDays(19)->format('Y-m-d'),
                    'jam' => '18:30',
                    'durasi_workout' => '60 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Latin Dance Workout',
                    'deskripsi' => 'Kelas Zumba dengan musik Latin untuk kardio yang menyenangkan.',
                    'equipment' => 'Dance Shoes, Water Bottle',
                    'kategori' => 'Without Equipment',
                    'exercises' => 10,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Suspension Training',
                    'kategori_jadwal' => 'Functional',
                    'tanggal' => Carbon::today()->addDays(20)->format('Y-m-d'),
                    'jam' => '08:00',
                    'durasi_workout' => '50 menit',
                ],
                'workout' => [
                    'nama_workout' => 'TRX Full Body',
                    'deskripsi' => 'Latihan menggunakan suspension trainer untuk kekuatan functional.',
                    'equipment' => 'TRX System, Anchor Point',
                    'kategori' => 'With Equipment',
                    'exercises' => 9,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Hill Sprints',
                    'kategori_jadwal' => 'Speed Training',
                    'tanggal' => Carbon::today()->addDays(20)->format('Y-m-d'),
                    'jam' => '06:45',
                    'durasi_workout' => '35 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Hill Repeat Sprints',
                    'deskripsi' => 'Latihan sprint di tanjakan untuk meningkatkan kecepatan dan power.',
                    'equipment' => 'Running Shoes, Stopwatch',
                    'kategori' => 'With Equipment',
                    'exercises' => 5,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Obliques & Side Abs',
                    'kategori_jadwal' => 'Core Training',
                    'tanggal' => Carbon::today()->addDays(21)->format('Y-m-d'),
                    'jam' => '11:00',
                    'durasi_workout' => '40 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Side Core Strengthening',
                    'deskripsi' => 'Latihan khusus untuk obliques dan otot perut samping.',
                    'equipment' => 'Exercise Mat, Medicine Ball, Side Bend Machine',
                    'kategori' => 'With Equipment',
                    'exercises' => 10,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Stair Climber',
                    'kategori_jadwal' => 'Cardio',
                    'tanggal' => Carbon::today()->addDays(21)->format('Y-m-d'),
                    'jam' => '17:15',
                    'durasi_workout' => '30 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Stair Machine Intervals',
                    'deskripsi' => 'Latihan interval pada stair climber machine.',
                    'equipment' => 'Stair Climber Machine, Towel',
                    'kategori' => 'With Equipment',
                    'exercises' => 4,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Pull-up Progression',
                    'kategori_jadwal' => 'Calisthenics',
                    'tanggal' => Carbon::today()->addDays(22)->format('Y-m-d'),
                    'jam' => '09:00',
                    'durasi_workout' => '55 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Pull-up Strength Building',
                    'deskripsi' => 'Program progresif untuk meningkatkan jumlah pull-up.',
                    'equipment' => 'Pull-up Bar, Resistance Bands',
                    'kategori' => 'With Equipment',
                    'exercises' => 7,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Aqua Aerobics',
                    'kategori_jadwal' => 'Low Impact',
                    'tanggal' => Carbon::today()->addDays(22)->format('Y-m-d'),
                    'jam' => '10:00',
                    'durasi_workout' => '45 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Water-based Workout',
                    'deskripsi' => 'Latihan aerobik di dalam air untuk mengurangi tekanan sendi.',
                    'equipment' => 'Swimsuit, Water Shoes, Pool Noodle',
                    'kategori' => 'With Equipment',
                    'exercises' => 9,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Rotator Cuff',
                    'kategori_jadwal' => 'Prehab',
                    'tanggal' => Carbon::today()->addDays(23)->format('Y-m-d'),
                    'jam' => '08:30',
                    'durasi_workout' => '25 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Shoulder Prehab Routine',
                    'deskripsi' => 'Latihan untuk menguatkan rotator cuff dan mencegah cedera bahu.',
                    'equipment' => 'Light Dumbbells, Resistance Bands',
                    'kategori' => 'With Equipment',
                    'exercises' => 6,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Battle Ropes',
                    'kategori_jadwal' => 'HIIT',
                    'tanggal' => Carbon::today()->addDays(23)->format('Y-m-d'),
                    'jam' => '17:45',
                    'durasi_workout' => '20 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Battle Ropes Conditioning',
                    'deskripsi' => 'Latihan high intensity menggunakan battle ropes.',
                    'equipment' => 'Battle Ropes, Timer',
                    'kategori' => 'With Equipment',
                    'exercises' => 8,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Neck & Traps',
                    'kategori_jadwal' => 'Specialized',
                    'tanggal' => Carbon::today()->addDays(24)->format('Y-m-d'),
                    'jam' => '11:30',
                    'durasi_workout' => '35 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Neck Strengthening',
                    'deskripsi' => 'Latihan khusus untuk otot leher dan upper traps.',
                    'equipment' => 'Neck Harness, Light Weights',
                    'kategori' => 'With Equipment',
                    'exercises' => 5,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Partner Workout',
                    'kategori_jadwal' => 'Group Training',
                    'tanggal' => Carbon::today()->addDays(24)->format('Y-m-d'),
                    'jam' => '16:00',
                    'durasi_workout' => '60 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Partner Exercises Routine',
                    'deskripsi' => 'Latangan dengan partner untuk motivasi dan variasi.',
                    'equipment' => 'Medicine Ball, Resistance Bands',
                    'kategori' => 'With Equipment',
                    'exercises' => 8,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Plyometric Training',
                    'kategori_jadwal' => 'Explosive',
                    'tanggal' => Carbon::today()->addDays(25)->format('Y-m-d'),
                    'jam' => '08:00',
                    'durasi_workout' => '40 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Jump Training for Power',
                    'deskripsi' => 'Latihan plyometric untuk meningkatkan explosive power.',
                    'equipment' => 'Plyo Box, Cones, Mat',
                    'kategori' => 'With Equipment',
                    'exercises' => 7,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Incline Walking',
                    'kategori_jadwal' => 'Low Impact Cardio',
                    'tanggal' => Carbon::today()->addDays(25)->format('Y-m-d'),
                    'jam' => '18:30',
                    'durasi_workout' => '45 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Treadmill Incline Walk',
                    'deskripsi' => 'Berjalan di treadmill dengan incline untuk kardio rendah dampak.',
                    'equipment' => 'Treadmill, Heart Rate Monitor',
                    'kategori' => 'With Equipment',
                    'exercises' => 4,
                    'status' => 'selesai',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Cable Machine',
                    'kategori_jadwal' => 'Isolation',
                    'tanggal' => Carbon::today()->addDays(26)->format('Y-m-d'),
                    'jam' => '10:00',
                    'durasi_workout' => '65 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Cable Exercises Variety',
                    'deskripsi' => 'Berbagai latihan menggunakan cable machine untuk isolasi otot.',
                    'equipment' => 'Cable Machine, Various Attachments',
                    'kategori' => 'With Equipment',
                    'exercises' => 10,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Fartlek Running',
                    'kategori_jadwal' => 'Running',
                    'tanggal' => Carbon::today()->addDays(26)->format('Y-m-d'),
                    'jam' => '06:30',
                    'durasi_workout' => '50 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Fartlek Speed Play',
                    'deskripsi' => 'Latihan lari fartlek dengan variasi kecepatan spontan.',
                    'equipment' => 'Running Shoes, GPS Watch',
                    'kategori' => 'With Equipment',
                    'exercises' => 5,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Pre-Workout Mobility',
                    'kategori_jadwal' => 'Warm-up',
                    'tanggal' => Carbon::today()->addDays(27)->format('Y-m-d'),
                    'jam' => '08:15',
                    'durasi_workout' => '15 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Dynamic Warm-up Routine',
                    'deskripsi' => 'Rutinitas pemanasan dinamis sebelum latihan utama.',
                    'equipment' => 'Mat, Foam Roller',
                    'kategori' => 'With Equipment',
                    'exercises' => 8,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Cool Down Routine',
                    'kategori_jadwal' => 'Recovery',
                    'tanggal' => Carbon::today()->addDays(27)->format('Y-m-d'),
                    'jam' => '19:45',
                    'durasi_workout' => '20 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Post-Workout Stretching',
                    'deskripsi' => 'Rutinitas pendinginan dan stretching setelah latihan.',
                    'equipment' => 'Mat, Stretching Strap',
                    'kategori' => 'With Equipment',
                    'exercises' => 6,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Isometric Training',
                    'kategori_jadwal' => 'Strength Endurance',
                    'tanggal' => Carbon::today()->addDays(28)->format('Y-m-d'),
                    'jam' => '09:30',
                    'durasi_workout' => '35 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Static Hold Workout',
                    'deskripsi' => 'Latihan isometric (static holds) untuk kekuatan dan endurance.',
                    'equipment' => 'Wall, Chair, Timer',
                    'kategori' => 'Without Equipment',
                    'exercises' => 6,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Posture Correction',
                    'kategori_jadwal' => 'Rehab',
                    'tanggal' => Carbon::today()->addDays(28)->format('Y-m-d'),
                    'jam' => '17:00',
                    'durasi_workout' => '40 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Postural Strength Exercises',
                    'deskripsi' => 'Latihan untuk memperbaiki postur tubuh dan menguatkan otot postural.',
                    'equipment' => 'Resistance Bands, Mirror',
                    'kategori' => 'With Equipment',
                    'exercises' => 7,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Vacation Workout',
                    'kategori_jadwal' => 'Minimalist',
                    'tanggal' => Carbon::today()->addDays(29)->format('Y-m-d'),
                    'jam' => '07:30',
                    'durasi_workout' => '30 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Hotel Room Workout',
                    'deskripsi' => 'Rutinitas latihan minimalis yang bisa dilakukan di kamar hotel.',
                    'equipment' => 'Tidak ada',
                    'kategori' => 'Without Equipment',
                    'exercises' => 9,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Endurance Run',
                    'kategori_jadwal' => 'Long Distance',
                    'tanggal' => Carbon::today()->addDays(29)->format('Y-m-d'),
                    'jam' => '16:30',
                    'durasi_workout' => '120 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Long Slow Distance Run',
                    'deskripsi' => 'Lari jarak jauh dengan pace sedang untuk meningkatkan endurance.',
                    'equipment' => 'Running Shoes, Hydration Belt',
                    'kategori' => 'With Equipment',
                    'exercises' => 3,
                    'status' => 'belum',
                ]
            ],
            [
                'jadwal' => [
                    'nama_jadwal' => 'Active Rest Day',
                    'kategori_jadwal' => 'Recovery',
                    'tanggal' => Carbon::today()->addDays(30)->format('Y-m-d'),
                    'jam' => '10:00',
                    'durasi_workout' => '45 menit',
                ],
                'workout' => [
                    'nama_workout' => 'Light Activity Recovery',
                    'deskripsi' => 'Aktivitas ringan pada hari istirahat untuk mempercepat pemulihan.',
                    'equipment' => 'Walking Shoes, Foam Roller',
                    'kategori' => 'With Equipment',
                    'exercises' => 5,
                    'status' => 'belum',
                ]
            ]
        ];

        $workoutData = array_slice($workoutData, 0, 50);

        foreach ($workoutData as $data) {
            $jadwal = JadwalWorkout::create($data['jadwal']);
            
            $workoutData = $data['workout'];
            $workoutData['jadwal_workout_id'] = $jadwal->id;
            
            Workout::create($workoutData);
        }
    }
}