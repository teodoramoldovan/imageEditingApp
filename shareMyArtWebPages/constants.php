<?php
const SITE_ROOT = "/var/www/imageUpload/shareMyArtWebPages/";
const UPLOADS_FOLDER_ROOT = SITE_ROOT . "uploads/";

const IMAGE_TITLE = 'imageTitle';
const IMAGE_DESCRIPTION = 'imageDescription';
const ARTIST_EMAIL = 'artistEmail';
const ARTIST_NAME = 'artistName';
const CAMERA_SPECIFICATIONS = 'cameraSpecifications';
const PRICE = 'price';
const CAPTURE_DATE = 'captureDate';
const TAGS = 'tags';
const IMAGE_NAME = 'name';

const IMAGE = 'image';
const TEMPORARY_FILE_LOCATION = 'tmp_name';


const IMAGE_TITLE_EMPTY_ERROR_TEXT = 'Please enter an image title';
const IMAGE_DESCRIPTION_EMPTY_ERROR_TEXT = 'Please enter a description';
const ARTIST_EMAIL_EMPTY_ERROR_TEXT = 'Please enter your email';
const ARTIST_NAME_EMPTY_ERROR_TEXT = 'Please enter your name';
const CAMERA_SPECIFICATIONS_EMPTY_ERROR_TEXT = 'Please enter your camera specifications';
const PRICE_EMPTY_ERROR_TEXT = 'Please enter a price';
const CAPTURE_DATE_EMPTY_ERROR_TEXT = 'Please enter the capture date';
const IMAGE_UPLOAD_EMPTY_ERROR_TEXT = 'Please select an image to upload';
const TAGS_EMPTY_ERROR_TEXT = "Please select at least one tag";

const ARTIST_EMAIL_ERROR_TEXT = 'The email you entered is not a valid email';
const PRICE_ERROR_TEXT = 'The price you entered is not valid. It must be a positive number';
const CAPTURE_DATE_ERROR_TEXT = 'Unless you are from the future, the date you entered is not valid';
const TAGS_ERROR_TEXT = "Please select a tag from the list";

const IMAGE_TITLE_ERROR = 'imageTitleError';
const IMAGE_DESCRIPTION_ERROR = 'imageDescriptionError';
const ARTIST_EMAIL_ERROR = 'artistEmailError';
const ARTIST_NAME_ERROR = 'artistNameError';
const CAMERA_SPECIFICATIONS_ERROR = 'cameraSpecificationsError';
const PRICE_ERROR = 'priceError';
const CAPTURE_DATE_ERROR = 'captureDateError';
const TAGS_ERROR = 'tagsError';
const IMAGE_UPLOAD_ERROR = 'imageUploadeError';

const VALID_TAGS = ['Nature', 'Sunset', 'Grayscale', 'High contrast'];