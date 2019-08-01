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

<div class="form-upload" style="max-width: 100%">
    <form action="" method="get" enctype="multipart/form-data">


        <div>
            <label for="query" class="form-upload-label">Search</label>
            <input id="query" type="text"
                   name="query" class="form-control"
                   value="<?php echo $this->queryData; ?>"/>
        </div>

        <div>
            <label for="sorts" class="form-upload-label">Sort by</label><br/>
            <select id="sorts" class="form-control" name="sort">
                <option value="title" selected="selected">Title</option>
                <option value="camera_specifications">Camera Specifications</option>
                <option value="capture_date">Capture Date</option>

            </select>

            <br/>
            <select id="sorts" class="form-control" name="direction">
                <option value="ASC" selected="selected">Ascending</option>
                <option value="DESC">Descending</option>

            </select>
        </div>


        <br/>


        <input type="submit" class="btn btn-info btn-lg btn-block" value="Search"/>
    </form>
</div>


<div class="row form-upload" style="max-width: 100%">

    <div class="col" style="max-width: 150px">
        <form class="" method="post" action="">

            <div class="form-group ">

                <p style="color: white">Number of products per page:</p>
                <div class="radio">

                    <label style="color:white">
                        <input type="radio" name="pages"
                               value="3" <?php if (3 === $this->resultsPerPage) echo ' checked="checked"'; ?>
                        >
                        3
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
                               value="9" <?php if (9 === $this->resultsPerPage) echo ' checked="checked"'; ?>>
                        9
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

<div class="row form-upload" style="max-width: 100%;">


    <?php if ($this->page != 0) { ?>
        <a href="/?page=<?php echo $prev; ?>&query=<?php echo $this->queryData; ?>&sort=<?php echo $this->sortData; ?>&direction=<?php echo $this->directionData; ?>">
            <?php echo '<< Previous page'; ?>
        </a>
    <?php } ?>



    <?php if ($this->resultsPerPage <= $numberOfProducts) { ?>
        <a style=" margin-left: 20px"
           href="/?page=<?php echo $next; ?>&query=<?php echo $this->queryData; ?>&sort=<?php echo $this->sortData; ?>&direction=<?php echo $this->directionData; ?>">
            <?php echo 'Next page >>'; ?>
        </a>
    <?php } ?>


</div>

</body>

</html>