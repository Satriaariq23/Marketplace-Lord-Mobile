<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@marketplacelm.test'],
            [
                'name' => 'Admin Marketplace',
                'phone' => '6281234567890',
                'password' => Hash::make('password123'),
                'is_admin' => true,
            ]
        );

        User::updateOrCreate(
            ['email' => 'buyer@marketplacelm.test'],
            [
                'name' => 'Buyer Demo',
                'phone' => '628111222333',
                'password' => Hash::make('password123'),
                'is_admin' => false,
            ]
        );

        $products = [
            [
                'title' => 'Lord Mobile Rally Lead C25 1.2B Might',
                'category' => 'Lord Mobile',
                'castle_level' => 25,
                'might' => 1200000000,
                'troop_t4' => 4300000,
                'troop_t5' => 900000,
                'kingdom' => 'K1321',
                'account_role' => 'Rally Lead',
                'bind_status' => 'Unbind Ready',
                'migration_ticket_ready' => true,
                'hero_grade' => '8 Gold Heroes',
                'familiar_grade' => '5 Elder Familiar',
                'research_summary' => 'Military 98%, Economy 86%, Monster Hunt 75%',
                'description' => 'Akun war siap pakai, cocok untuk guild kompetitif dengan lineup rally lengkap.',
                'price' => 8450000,
                'stock' => 1,
            ],
            [
                'title' => 'Lord Mobile Trap Account C25 780M Might',
                'category' => 'Lord Mobile',
                'castle_level' => 25,
                'might' => 780000000,
                'troop_t4' => 3000000,
                'troop_t5' => 250000,
                'kingdom' => 'K1458',
                'account_role' => 'Trap',
                'bind_status' => 'Google Bound',
                'migration_ticket_ready' => false,
                'hero_grade' => '5 Gold Heroes',
                'familiar_grade' => '3 Elder Familiar',
                'research_summary' => 'Military 93%, Economy 82%, Monster Hunt 70%',
                'description' => 'Akun trap dengan komposisi troop defense dan gear jebakan yang kuat.',
                'price' => 4850000,
                'stock' => 1,
            ],
            [
                'title' => 'Lord Mobile Farmer C25 420M Might',
                'category' => 'Lord Mobile',
                'castle_level' => 25,
                'might' => 420000000,
                'troop_t4' => 1700000,
                'troop_t5' => 0,
                'kingdom' => 'K1660',
                'account_role' => 'Farmer',
                'bind_status' => 'FB Bound',
                'migration_ticket_ready' => true,
                'hero_grade' => '3 Gold Heroes',
                'familiar_grade' => '2 Elder Familiar',
                'research_summary' => 'Military 71%, Economy 88%, Monster Hunt 62%',
                'description' => 'Akun farming untuk supply guild, resource production tinggi dan maintenance murah.',
                'price' => 2150000,
                'stock' => 1,
            ],
        ];

        foreach ($products as $item) {
            Product::updateOrCreate(
                ['title' => $item['title']],
                [
                    'slug' => Str::slug($item['title']).'-'.Str::lower(Str::random(4)),
                    'description' => $item['description'],
                    'category' => $item['category'],
                    'castle_level' => $item['castle_level'],
                    'might' => $item['might'],
                    'troop_t4' => $item['troop_t4'],
                    'troop_t5' => $item['troop_t5'],
                    'kingdom' => $item['kingdom'],
                    'account_role' => $item['account_role'],
                    'bind_status' => $item['bind_status'],
                    'migration_ticket_ready' => $item['migration_ticket_ready'],
                    'hero_grade' => $item['hero_grade'],
                    'familiar_grade' => $item['familiar_grade'],
                    'research_summary' => $item['research_summary'],
                    'price' => $item['price'],
                    'stock' => $item['stock'],
                    'is_active' => true,
                    'whatsapp_number' => '6281234567890',
                ]
            );
        }
    }
}
