<!DOCTYPE html>
<html>
<head>
    <title>Explora Marte</title>
    <style>@import url('style.css');</style>
    <style>@import url('https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap');</style>
</head>
<body>
    <h1>Explora Marte &#128640;</h1>
    <h5>Ingresa una fecha para ver una imagen del rover Curiosity en el planeta rojo</h5>
    <p>¡Atent@! Recuerd que el formato debe ser: YYYY-MM-DD</p>
    <form method="POST" action="">
        <input type="text" name="earth_date" placeholder="Fecha (YYYY-MM-DD)">
        <input type="submit" name="submit" value="Mostrar imagen">
    </form>
    <?php
// API KEY
$apiKey = '2bkxaWuhYDDTzPoKaCZZG0Inm8qzXXZkDIdftIbF';

/**
 * Verificar si se ha enviado el formulario
 *
 * @param string $submit El nombre del campo de envío del formulario
 */
if (isset($_POST['submit'])) {
    // Obtener la fecha ingresada por el usuario
    $earthDate = $_POST['earth_date'];

    // URL de la API con la fecha proporcionada
    $url = 'https://api.nasa.gov/mars-photos/api/v1/rovers/curiosity/photos?earth_date=' . $earthDate . '&api_key=' . $apiKey;

    // Realizar la petición HTTP GET
    $response = file_get_contents($url);

    // Verificar si se recibió una respuesta
    if ($response !== false) {
        // Decodificar la respuesta JSON
        $data = json_decode($response, true);

        // Obtener las fotos del resultado
        $photos = $data['photos'];

        // Mostrar la primera imagen si está disponible
        if (!empty($photos)) {
            $photo = $photos[0];
            echo '<div>';
            echo '<img src="' . $photo['img_src'] . '" alt="Foto de Marte">';
            echo '</div>';
        } else {
            echo 'No se encontraron fotos para la fecha especificada.';
        }
    } else {
        // Error al realizar la petición
        echo "Error al acceder a la API :-(";
    }
}
?>
</body>
</html>
