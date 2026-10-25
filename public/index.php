<?php

declare(strict_types=1);

// Kelias nepriklauso nuo to, iš kurio aplanko paleidžiama programa
require_once __DIR__ . '/../src/ProductKeyValidator.php';

// Saugus teksto atvaizdavimas HTML puslapyje
function escape(string $value): string
{
    return htmlspecialchars(
        $value,
        ENT_QUOTES | ENT_SUBSTITUTE,
        'UTF-8'
    );
}

$productKey = '';
$normalizedKey = '';
$error = '';
$isSubmitted = $_SERVER['REQUEST_METHOD'] === 'POST';

if ($isSubmitted) {
    $input = $_POST['product_key'] ?? '';

    $result = validateProductKey($input);
    $error = $result['error'];

    // Formoje paliekame pradinę, tinkamo dydžio UTF-8 įvestį
    if (
        is_string($input)
        && strlen($input) <= 4096
        && preg_match('//u', $input) === 1
    ) {
        $productKey = $input;
    }

    if ($error === '') {
        $normalizedKey = $result['key'];
    }
}

?>
<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Heater Configurator</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="workspace">
        <header class="masthead">
            <a class="brand" href="/" aria-label="Pradinis puslapis">
                <span class="brand-mark" aria-hidden="true">HC</span>
                <span>Heater<br>Configurator</span>
            </a>

            <p class="header-note">
                Elektrinių šildytuvų<br>
                konfigūravimo sistema
            </p>
        </header>

        <main>
            <div class="page-heading">
                <p class="eyebrow">01 / Gaminio duomenys</p>
                <h1>Pradėkime<br>nuo rakto.</h1>
                <p class="intro">
                    Įveskite gaminio raktą. Sistema paruoš įvestį
                    tolesniam parametrų nuskaitymui.
                </p>
            </div>

            <div class="work-area">
                <section class="entry-panel" aria-labelledby="entry-title">
                    <div class="section-heading">
                        <span class="section-number">A</span>
                        <h2 id="entry-title">Rakto įvedimas</h2>
                    </div>

                    <form method="post">
                        <label for="product-key">Gaminio raktas</label>

                        <p id="key-help" class="field-help">
                            Įklijuokite visą raktą viena eilute
                        </p>

                        <input
                            id="product-key"
                            name="product_key"
                            type="text"
                            maxlength="100"
                            value="<?= escape($productKey) ?>"
                            placeholder="Įveskite gaminio raktą"
                            aria-describedby="key-help<?= $error !== '' ? ' key-error' : '' ?>"
                            <?= $error !== '' ? 'aria-invalid="true"' : '' ?>
                            required
                        >

                        <?php if ($error !== ''): ?>
                            <p id="key-error" class="error" role="alert">
                                <?= escape($error) ?>
                            </p>
                        <?php endif; ?>

                        <div class="form-actions">
                            <button type="submit">
                                Patikrinti įvestį
                                <span aria-hidden="true">↗</span>
                            </button>

                            <a class="reset-link" href="/">Išvalyti</a>
                        </div>
                    </form>
                </section>

                <aside class="notes" aria-labelledby="notes-title">
                    <p class="eyebrow">Pastabos</p>
                    <h2 id="notes-title">Kas tikrinama?</h2>

                    <ul>
                        <li>Ar raktas įvestas.</li>
                        <li>Ar neviršyta 100 simbolių riba.</li>
                        <li>Ar nėra neleistinų valdymo simbolių.</li>
                    </ul>

                    <p>
                        Pasikartojantys tarpai suvienodinami.
                        Raidės ir skyrybos ženklai išsaugomi.
                    </p>
                </aside>
            </div>

            <section class="result-panel" aria-labelledby="result-title">
                <div class="section-heading">
                    <span class="section-number">B</span>
                    <h2 id="result-title">Patikros rezultatas</h2>
                </div>

                <?php if ($normalizedKey !== ''): ?>
                    <p class="result-status">Įvestis paruošta</p>

                    <dl>
                        <dt>Normalizuotas raktas</dt>
                        <dd class="key-value">
                            <?= escape($normalizedKey) ?>
                        </dd>
                    </dl>

                    <p class="result-note">
                        Atlikta bendroji įvesties patikra.
                        Gaminio formato ir parametrų teisingumas
                        dar netikrintas.
                    </p>
                <?php elseif ($error !== ''): ?>
                    <p class="empty-state">
                        Ištaisykite pažymėtą įvestį ir pakartokite patikrą.
                    </p>
                <?php else: ?>
                    <p class="empty-state">
                        Pateikus raktą, čia bus rodomas patikros rezultatas.
                    </p>
                <?php endif; ?>
            </section>
        </main>

        <footer class="footer">
            <span>HC / Rakto paruošimas</span>
            <span>Parametrų dekodavimas — kitame etape</span>
        </footer>
    </div>
</body>
</html>