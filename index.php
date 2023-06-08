<?php

$hotels = [

    [
        'name' => 'Hotel Belvedere',
        'description' => 'Hotel Belvedere Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Hotel Futuro Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Hotel Rivamare Descrizione',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Hotel Bellavista Descrizione',
        'parking' => false,
        'vote' => 5,
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Hotel Milano Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50
    ],

];
$parcheggioFilter = $_GET['parcheggio'] ?? '';
$votoFilter = $_GET['voto'] ?? '';
$filteredHotels = [];

foreach ($hotels as $hotel) {
    if ($parcheggioFilter === '' || ($parcheggioFilter === 'si' && $hotel['parking']) || ($parcheggioFilter === 'no' && !$hotel['parking'])) {
        if ($votoFilter === '' || $hotel['vote'] >= $votoFilter) {
            $filteredHotels[] = $hotel;
        }
    }
}
$filteredHotels = array_filter($hotels, function ($hotel) use ($parcheggioFilter, $votoFilter) {
    $parcheggioMatch = ($parcheggioFilter === '') ||
        ($parcheggioFilter === 'si' && $hotel['parking']) ||
        ($parcheggioFilter === 'no' && !$hotel['parking']);

    $votoMatch = ($votoFilter === '') || ($hotel['vote'] == $votoFilter);

    return $parcheggioMatch && $votoMatch;
});
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotels</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <main>
        <form action="index.php" method="$_GET">
            <label for="parcheggio">Filtro Parcheggio:</label>
            <select name="parcheggio" id="parcheggio">
                <option value="">Tutti</option>
                <option value="si">Si</option>
                <option value="no">No</option>
            </select>
            <br>
            <label for="voto">Filtro Voto:</label>
            <input type="number" name="voto" id="voto" min="1" max="5">
            <br>
            <input type="submit" value="Filtra">
        </form>
        <section>
            <table class="table table-success table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descrizione</th>
                        <th>Parcheggio</th>
                        <th>Voto</th>
                        <th>Distanza dal centro</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($filteredHotels as $hotel) : ?>
                        <tr>
                            <td><?php echo $hotel['name']; ?></td>
                            <td><?php echo $hotel['description']; ?></td>
                            <td><?php echo $hotel['parking'] ? 'Sì' : 'No'; ?></td>
                            <td><?php echo $hotel['vote']; ?></td>
                            <td><?php echo $hotel['distance_to_center']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>

</body>

</html>