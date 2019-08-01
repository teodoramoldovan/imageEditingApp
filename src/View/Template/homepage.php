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
    <link rel="stylesheet" type="text/css" href="../../../css/styles.css">

</head>
<body>

<div class="row form-upload" style="max-width: 100%">

    <div class="col" style="max-width: 150px">
        <form class="" method="post" action="">

            <div class="form-group ">

                <p style="color: white">Number of products per page:</p>
                <div class="radio">

                    <label style="color:white">
                        <input type="radio" name="pages"
                               value="5" <?php if (5 === $this->resultsPerPage) echo ' checked="checked"'; ?>
                        >
                        5
                    </label>


                </div>


                <div class="radio">

                    <label style="color:white">
                        <input type="radio" name="pages"
                               value="6" <?php if (6 === $this->resultsPerPage) echo ' checked="checked"'; ?>>
                        6
                    </label>


                </div>
                <div class="radio">

                    <label style="color:white">
                        <input type="radio" name="pages"
                               value="10" <?php if (10 === $this->resultsPerPage) echo ' checked="checked"'; ?>>
                        10
                    </label>


                </div>

            </div>

            <button class="btn btn-lg btn-primary btn-block form-group" type="submit" formnovalidate>
                Show
            </button>
        </form>
    </div>
    <div class="col row">
        <?php foreach ($this->products as $product) { ?>

            <div class="col-md-4" align="center">


                <img style="max-width: 300px; max-height: 200px"
                     src=<?php echo self::UPLOADS_FOLDER_ROOT . $product->getThumbnailPath(); ?>>
                <div class="caption">
                    <a href="/product/show/<?php echo $product->getId(); ?>" style="color:white ">
                        Title: <?php echo $product->getTitle(); ?> </a>
                </div>


            </div>

        <?php } ?>
    </div>


</div>

<div class="row form-upload" style="max-width: 100%;position: relative;">

    <?php if ($this->page != 0) { ?>
        <a href="/?page=<?php echo $prev; ?>">Previous page</a>
    <?php } ?>
    </p>

    <p>
        <?php if ($this->resultsPerPage <= $numberOfProducts) { ?>
            <a href="/?page=<?php echo $next; ?> ">Next page</a>
        <?php } ?>
    </p>

</div>

</body>

</html>