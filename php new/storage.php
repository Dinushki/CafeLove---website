<?php
function json_path($name) {
    return __DIR__ . "/data/$name";
}
function load_json_file(string $filename): array {
    $path = json_path($filename);
    if (!file_exists($path)) return [];
    $data = json_decode(file_get_contents($path), true);
    return is_array($data) ? $data : [];
}
function save_json_file(string $filename, array $data): bool {
    $path = json_path($filename);
    return file_put_contents($path, json_encode($data, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)) !== false;
}
function append_json_item(string $filename, array $item): bool {
    $data = load_json_file($filename);
    $data[] = $item;
    return save_json_file($filename, $data);
}
function sanitize_input($v) {
    return trim(strip_tags($v));
}
?>