<?php
echo "<h1>Hello! welcome to the authenticated users page</h1>";
if (!empty($id)) echo "<p>You requested user {$id}</p>";
if (empty($id)) echo "<p>No users found that have registered yet</p>";