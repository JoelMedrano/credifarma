if (isset($_FILES["picture"]["tmp_name"]) && !empty($_FILES["picture"]["tmp_name"])) {

$file = $_FILES["picture"]["tmp_name"];
$type = $_FILES["picture"]["type"];
$folder = "users/" . $id;
$name = $id;
$width = 300;
$height = 300;

$picture = TemplateController::saveImage($file, $folder, $type, $width, $height, $name);

var_dump($picture);
}