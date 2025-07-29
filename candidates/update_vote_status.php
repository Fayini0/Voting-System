<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $enable_votes = isset($_POST['enable_votes']) ? true : false;

    // Update your configuration file or database
    $config = json_decode(file_get_contents('config.json'), true);
    $config['votes_enabled'] = $enable_votes;

    // Save updated config
    file_put_contents('config.json', json_encode($config));

    // Redirect back to manage votes page
    header("Location: manage_votes.php");
    exit();
}
