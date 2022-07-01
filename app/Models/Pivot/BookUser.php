<?php

namespace App\Models\Pivot;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\Pivot;

class BookUser extends Pivot
{
    public static $statuses = [
        'ASK TO BORROW' => 'Ingin Meminjam',
        'ON LOAN' => 'Sedang dipinjam',
        'RETURNED' => 'Sudah dikembalikan',
    ];

    public static $validation = [
        'ASK TO BORROW', 'ON LOAN',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
