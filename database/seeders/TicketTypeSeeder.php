<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\TicketType;

class TicketTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ticketTypes = [
            [
                'name' => 'Early Bird',
                'price' => 50.00,
                'quantity' => 100,
            ],
            [
                'name' => 'Regular',
                'price' => 100.00,
                'quantity' => 80,
            ],
            [
                'name' => 'VIP',
                'price' => 200.00,
                'quantity' => 50,
            ],
        ];

        foreach ($ticketTypes as $ticketType) {
            if (!TicketType::where('name', $ticketType['name'])->exists()) {
                TicketType::create($ticketType);
            }
        }
    }
}
