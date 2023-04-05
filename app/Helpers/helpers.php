<?php

if (! function_exists('calculatingFines')) {
    function calculatingFines($book)
    {
        $limit = \Carbon\Carbon::create($book->return_limit);
        if (now() > $limit && $book->status == 'ON LOAN') {
            return $limit->diffInDays() * $book->fine;
        }

        return 0;
    }
}

if (! function_exists('createQRCodeBook')) {
    function createQRCodeBook($bookTitle)
    {
        $qrcode = base64_encode(
            \QrCode::format('svg')
                ->size(200)
                ->errorCorrection('H')
                ->generate(str_replace(' ', '+', $bookTitle)),
        );

        return $qrcode;
    }
}
