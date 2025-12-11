<?php
require_once __DIR__ . "/storage.php";
require_once __DIR__ . "/auth.php";
$type = $_GET['type'] ?? '';
$action = $_GET['action'] ?? '';
$id = intval($_GET['id'] ?? -1);
$valid = ["users","reservations","messages"];
if (!in_array($type,$valid)) die("Invalid type");
$filename = $type . ".json";
$data = load_json_file($filename);
if ($action === "delete") {
    if (isset($data[$id])) {
        array_splice($data, $id, 1);
        save_json_file($filename, $data);
    }
    header("Location: admin.php?msg=deleted");
    exit;
}
if ($action === "update") {
    if (!isset($data[$id])) die("Invalid ID");
    foreach ($_POST as $k=>$v) $data[$id][$k] = sanitize_input($v);
    save_json_file($filename, $data);
    header("Location: admin.php?msg=updated");
    exit;
}
die("Invalid action");
?>