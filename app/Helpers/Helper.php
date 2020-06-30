<?php

function changePriceFormat($price): string
{
    return '$'.number_format($price / 100, 2);
}

function checkFileExist($image): string
{
    return $image && file_exists($image) ? asset($image) : asset('uploads/products/1024px-No_image_available.svg.png');
}


