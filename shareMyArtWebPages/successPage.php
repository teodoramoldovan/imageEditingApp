<?php
const DISPLAY_PAGE_KEYS = [
    'Image Title', 'Image Description', 'Artist\'s email',
    'Artist\'s name', 'Camera Specification', 'Price', 'Capture Date',
    'Tags', 'Image Name',
];
session_start();


$jsonData = file_get_contents($_SESSION['path']);

$decodedPreviouslySavedData = json_decode($jsonData, true);

$decodedPreviouslySavedData = array_combine(DISPLAY_PAGE_KEYS, $decodedPreviouslySavedData);


preg_match('/(?<folderPath>.*\/)/', $_SESSION['path'], $matches);


$filepath = $matches['folderPath'] . $decodedPreviouslySavedData['Image Name'];
$filepath = str_replace("/var/www/imageUpload/shareMyArtWebPages/", "", $filepath);


?>

<!DOCTYPE html>

<html lang="en">
<head>
    <title>ShareMyArt</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="resources/css/styles.css">

</head>

<body>
<div id="wrapper">

    <header>
        <div><img src="resources/logo.png"></div>

    </header>


    <div class="container" style="background-color: rgba(0,0,0,0.7);">

        <table class="table">
            <h1 style="color:white"> SUCCESS</h1>
            <br/>

            <h3 style="color:white"> You have uploaded the following data:</h3>
            <br/>
            <tbody>

            <?php foreach ($decodedPreviouslySavedData as $key => $value) { ?>
                <tr>
                    <td style="color:white">
                        <?php echo $key; ?>
                    </td>


                    <td style="color:white"><?php
                        if ('tags' === $key) {

                            echo implode(',', $value);
                        } else {
                            echo $value;
                        }
                        ?>
                    </td>
                </tr>
            <?php } ?>


            </tbody>
        </table>

        <img src='<?php echo $filepath; ?>' class="img-thumbnail" width="200" height="200">


    </div>

    <div style="clear: both;"></div>
</div>


</body>
</html>