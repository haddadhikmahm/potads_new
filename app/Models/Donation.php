<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['donor_name', 'amount', 'email', 'phone', 'message', 'payment_status', 'payment_method', 'transaction_id'])]
class Donation extends Model
{
    //
}
