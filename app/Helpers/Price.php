<?php

function changePriceFormat($price): string
{
    return '$'.number_format($price / 100, 2);
}
