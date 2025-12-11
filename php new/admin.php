<?php
require_once __DIR__ . '/storage.php';
require_once __DIR__ . '/auth.php';
$users = load_json_file("users.json");
$reservations = load_json_file("reservations.json");
$messages = load_json_file("messages.json");
$search = strtolower(trim($_GET['search'] ?? ''));
function matches($item, $search) {
    if ($search === '') return true;
    foreach ($item as $v) if (stripos((string)$v, $search) !== false) return true;
    return false;
}
function editBtn($t, $id) { return "<a href='admin.php?type=$t&edit=$id'>Edit</a>"; }
function delBtn($t, $id) { return "<a href='crud.php?type=$t&action=delete&id=$id' style='color:red;'>Delete</a>"; }
?>
<!DOCTYPE html><html><head><title>Admin Panel</title></head><body>
<h1>Admin Dashboard</h1>
<a href="logout_admin.php">Logout</a>
<form><input name="search" value="<?=$search?>" placeholder="Search..."></form><hr>
<?php
if (isset($_GET['type'],$_GET['edit'])) {
    $type = $_GET['type'];
    $id = intval($_GET['edit']);
    $file = $type.".json";
    $data = load_json_file($file);
    if (isset($data[$id])) {
        echo "<form method='POST' action='crud.php?type=$type&action=update&id=$id'>";
        foreach ($data[$id] as $k=>$v)
            echo "<label>$k</label><input name='$k' value='".htmlspecialchars($v)."'><br>";
        echo "<button>Save</button></form><hr>";
    }
}
?>
<h2>Users</h2><table>
<?php foreach ($users as $i=>$u): if (!matches($u,$search)) continue; ?>
<tr><td><?=$u['name']?></td><td><?=$u['email']?></td><td><?=$u['created_at']?></td>
<td><?=editBtn('users',$i)?> <?=delBtn('users',$i)?></td></tr>
<?php endforeach; ?></table>
<h2>Reservations</h2><table>
<?php foreach ($reservations as $i=>$r): if (!matches($r,$search)) continue; ?>
<tr><td><?=$r['name']?></td><td><?=$r['phone']?></td><td><?=$r['date']?></td>
<td><?=$r['people']?></td><td><?=$r['created_at']?></td>
<td><?=editBtn('reservations',$i)?> <?=delBtn('reservations',$i)?></td></tr>
<?php endforeach; ?></table>
<h2>Messages</h2><table>
<?php foreach ($messages as $i=>$m): if (!matches($m,$search)) continue; ?>
<tr><td><?=$m['name']?></td><td><?=$m['email']?></td><td><?=$m['message']?></td>
<td><?=$m['created_at']?></td><td><?=editBtn('messages',$i)?> <?=delBtn('messages',$i)?></td></tr>
<?php endforeach; ?></table></body></html>