<!DOCTYPE html>
<html lang="id">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'Dashboard GOODBIKE'; ?></title>
    <link rel="stylesheet" href="<?= base_url('css/style.css'); ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="icon" href="<?= base_url('images/favicon.ico'); ?>" type="image/x-icon">
    <meta name="description" content="Dashboard GOODBIKE - Mengelola jadwal service dan perawatan sepeda motor Anda.">
    <meta name="keywords" content="Dashboard, GOODBIKE, Service, Perawatan">
    <meta name="author" content="GOODBIKE Team">
    <meta name="csrf-token" content="<?= csrf_hash(); ?>">
    
</head>
<body>
