<?php

declare(strict_types=1);

/**
 * Patikrina įvestį ir suvienodina tarpus (dar reikės pagalvoti apie kitus simbolius, pvz. neatskiriamą tarpą??)
 *
 * Grąžina:
 * - key: paruoštą raktą;
 * - error: klaidos tekstą arba tuščią eilutę;
 */
function validateProductKey(mixed $input): array
{
    // Užklausoje vietoje teksto gali būti pateiktas ir masyvas
    if (!is_string($input)) {
        return [
            'key' => '',
            'error' => 'Gaminio raktas turi būti tekstas.',
        ];
    }

    // Prieš apdorojimą ribojame įvesties dydį ir tikriname UTF-8
    if (strlen($input) > 4096 || preg_match('//u', $input) !== 1) {
        return [
            'key' => '',
            'error' => 'Netinkama arba per ilga įvestis.',
        ];
    }

    // Suvienodiname horizontalius tarpus ir pašaliname juos kraštuose
    // Raidžių dydžio ir skyrybos ženklų nekeičiame
    $key = trim(
        preg_replace('/[\p{Zs}\t]+/u', ' ', $input),
        ' '
    );

    if ($key === '') {
        return [
            'key' => '',
            'error' => 'Įveskite gaminio raktą.',
        ];
    }

    // Naujos eilutės ir kiti valdymo simboliai rakte neleidžiami
    if (preg_match('/[\x00-\x1F\x7F]/u', $key)) {
        return [
            'key' => $key,
            'error' => 'Raktą įveskite viena eilute be valdymo simbolių.',
        ];
    }

    // Skaičiuojame simbolius, o ne UTF-8 baitus
    if (preg_match('/^.{1,100}$/us', $key) !== 1) {
        return [
            'key' => $key,
            'error' => 'Raktas negali būti ilgesnis nei 100 simbolių.',
        ];
    }

    return [
        'key' => $key,
        'error' => '',
    ];
}