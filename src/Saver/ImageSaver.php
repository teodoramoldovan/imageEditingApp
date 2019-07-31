<?php


namespace ShareMyArt\Saver;


use ShareMyArt\Request\Request;

class ImageSaver
{

    private const SITE_ROOT = "/var/www/imageUpload/";
    private const UPLOADS_FOLDER_ROOT = self::SITE_ROOT . "imageUploads/";
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function saveImage(): string
    {
        $savedImagePath = uniqid() . '.png';
        if (count($this->request->getFiles())) {
            move_uploaded_file($this->request->getFiles('image', 'tmp_name'),
                self::UPLOADS_FOLDER_ROOT . $savedImagePath);
        }

        return $savedImagePath;
    }


    public function saveTierWithoutWatermark(string $inputPath, string $outputPath, string $size)
    {
        if ($size === 'small') {
            $width = 50;
        }
        if ($size === 'medium') {
            $width = 100;
        }

        $command = ($size !== 'large')
            ? "php " . __DIR__ . "/../../imageEditProject/my_command_line_tool.php --input-file=" .
            self::UPLOADS_FOLDER_ROOT . $inputPath . " --output-file=" . self::UPLOADS_FOLDER_ROOT . $outputPath .
            " --width=" . $width . " 2>&1"
            : "php " . __DIR__ . "/../../imageEditProject/my_command_line_tool.php --input-file=" .
            self::UPLOADS_FOLDER_ROOT . $inputPath . " --output-file=" . self::UPLOADS_FOLDER_ROOT . $outputPath .
            " 2>&1";

        $this->executeTool($command);
    }

    private function executeTool(string $command)
    {
        system($command, $output);
    }

    public function saveTierWithWatermark(string $inputPath, string $outputPath, string $size)
    {
        if ($size === 'small') {
            $width = 50;
        }
        if ($size === 'medium') {
            $width = 100;
        }

        $command = ($size !== 'large')
            ? "php " . __DIR__ . "/../../imageEditProject/my_command_line_tool.php --input-file=" .
            self::UPLOADS_FOLDER_ROOT . $inputPath . " --output-file=" . self::UPLOADS_FOLDER_ROOT . $outputPath .
            " --width=" . $width . " --watermark=/var/www/imageUpload/imageEditProject/inputImages/watermark.png" . " 2>&1"
            : "php " . __DIR__ . "/../../imageEditProject/my_command_line_tool.php --input-file=" .
            self::UPLOADS_FOLDER_ROOT . $inputPath . " --output-file=" . self::UPLOADS_FOLDER_ROOT . $outputPath .
            " --watermark=/var/www/imageUpload/imageEditProject/inputImages/watermark.png" . " 2>&1";

        $this->executeTool($command);
    }

    public function saveThumbnail(string $inputPath, string $outputPath)
    {
        $command = "php " . __DIR__ . "/../../imageEditProject/my_command_line_tool.php --input-file=" .
            self::UPLOADS_FOLDER_ROOT . $inputPath . " --output-file=" . self::UPLOADS_FOLDER_ROOT . $outputPath .
            " 2>&1";
        $this->executeTool($command);
    }
}