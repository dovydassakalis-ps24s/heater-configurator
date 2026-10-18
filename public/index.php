<?php

declare(strict_types=1);

//pradinės formos reikšmės
$productKey = '';
$error = '';

//forma apdorojama tik tada, kai naudotojas ją pateikia
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = $_POST['product_key'] ?? '';

    //priimame tik tekstinę reikšmę ir pašaliname tarpus jos kraštuose
    $productKey = is_string($input) ? trim($input) : '';

    if ($productKey === '') {
        $error = 'Įveskite gaminio raktą.';
    } elseif (mb_strlen($productKey) > 100) {
        $error = 'Gaminio raktas negali būti ilgesnis nei 100 simbolių.';
    }
}

//saugiai paruošiame tekstą atvaizduoti HTML puslapyje
function escape(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
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
    <main class="container">
        <h1>Heater Configurator</h1>
        <p>Elektrinių šildytuvų konfigūravimo sistema</p>

        <h2>Gaminio rakto įvedimas</h2>

        <!--duomenys siunčiami į tą patį puslapį POST metodu-->
        <form method="post">
            <label for="product-key">Gaminio raktas</label>

            <input
                id="product-key"
                name="product_key"
                type="text"
                maxlength="100"
                value="<?= escape($productKey) ?>"
                placeholder="Įveskite gaminio raktą"
                required
            >

            <button type="submit">Pateikti</button>
        </form>

        <?php if ($error !== ''): ?>
            <p class="error" role="alert"><?= escape($error) ?></p>
        <?php elseif ($productKey !== ''): ?>
            <section class="result">
                <h2>Įvestas raktas</h2>
                <p><?= escape($productKey) ?></p>
                <p>**** Rakto dekodavimas bus įgyvendintas vėliau ****</p>
            </section>
        <?php endif; ?>
    </main>
</body>
</html>