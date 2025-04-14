<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // hasInvoices only works because the Customer model has invoices relationship method
        Customer::factory()->count(5)->hasInvoices(0)->create();
        Customer::factory()->count(25)->hasInvoices(10)->create(); // For each customer, generate 10 related invoices
        Customer::factory()->count(100)->hasInvoices(5)->create();
    }
}
