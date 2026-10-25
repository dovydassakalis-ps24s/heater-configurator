# Gaminio rakto specifikacija

Būsena: rengiamas aprašas, dalykinės taisyklės dar nepatvirtintos.

## Įgyvendintas įvesties paruošimas

- Priimama tekstinė UTF-8 įvestis.
- Pašalinami horizontalūs tarpai rakto pradžioje ir pabaigoje.
- Pasikartojantys horizontalūs tarpai pakeičiami vienu tarpu.
- Išsaugomas raidžių dydis, skyrybos ženklai ir segmentų tvarka.
- Atmetama tuščia įvestis ir valdymo simboliai.
- Po normalizavimo leidžiama iki 100 simbolių.
- Vėliau ateityje dar reikės papildyti.

100 simbolių riba yra laikinas programos apribojimas.
Ją reikės patikrinti pagal ilgiausius realius raktus.

Tarpų normalizavimo tinkamumą taip pat reikia patvirtinti
pagal įmonėje naudojamą rakto specifikaciją.

## Dar reikia patvirtinti

| Dalis | Klausimas |
|---|---|
| EMS B ir EMS NIS | Kaip atskiriami gaminio tipai? |
| Matmenys | Kokia jų tvarka, skirtukai ir vienetai? |
| Galia | Kokie skaičių formatai ir vienetai leidžiami? |
| S segmentas | Kokia tiksli reikšmė ir leistinos reikšmės? |
| P segmentas | Kokia tiksli reikšmė ir leistinos reikšmės? |
| Opcijos | Kokios opcijos galimos ir kaip jos žymimos? |
| Kryptis | Kokie žymėjimai ir ar segmentas privalomas? |

S ir P segmentų reikšmės nebus nustatomos vien pagal jų pavadinimą.

## Pirmas kontrolinis atvejis

- Atvejo ID: K-001
- Raktas: dar nepateiktas
- Klientas: dar nenurodytas
- Tikėtini parametrai: dar nepatvirtinti
- Tikėtini komponentų kodai ir kiekiai: dar nepatvirtinti
- Patvirtinimo šaltinis: dar nenurodytas
- Būsena: nepatvirtintas

Į viešą repozitoriją įtraukiami tik leidžiami viešinti duomenys.

## Kitas darbas

Patvirtinti pirmo rakto struktūrą ir tikėtinas parametrų reikšmes.
Pagal šį pavyzdį pradėti atskirą rakto dekodavimo modulį.