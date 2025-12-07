<?php

namespace Database\Factories;

use App\Models\ExpenseItem;
use App\Models\Program;
use App\Models\Expense;
use App\Models\LineItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpenseItemFactory extends Factory
{
    protected $model = ExpenseItem::class;

    public function definition()
    {
        return [
            'price' => $this->faker->randomFloat(2, 10, 500),
            'qty' => $this->faker->numberBetween(1, 10),
            'composite_price' => $this->faker->randomFloat(2, 10, 5000),
            'notes' => $this->faker->sentence,
            'program_id' => Program::factory(),
            'expense_id' => Expense::factory(),
            'mst_line_item_id' => LineItem::factory(),
        ];
    }
}
