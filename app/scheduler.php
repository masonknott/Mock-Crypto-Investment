<?php

while (true) {
    exec('php artisan update:cryptocurrencies');
    sleep(120);
}
