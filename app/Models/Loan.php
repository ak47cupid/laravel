<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $table = 'loans';

    protected $fillable = [
        'user_id',
        'monthly_salary',
        'loan_amount',
        'status',
        'term_months',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
