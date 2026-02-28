## 📁 CI4 File Manager & Storage Analytics System

A production-ready File Management module built with CodeIgniter 4 featuring uploads, validation, backups, filtering, and analytics.

🚀 Features

✅ File Upload Integration

✅ File Size Validation (Max 2MB configurable)

✅ File Type Filtering

✅ Secure File Download

✅ File Deletion

✅ Automatic Cleanup (Old Files)

✅ ZIP Backup Creation

✅ Storage Usage Analytics Dashboard

✅ Cron-based Automation Ready

✅ Basic Security Protection (Path validation)



## 🏗️ Project Structure

app/
 ├── Controllers/
 │     └── FileManager.php
 ├── Views/
 │     ├── file_view.php
 │     └── analytics.php
 └── Config/
       └── Routes.php

writable/
 └── uploads/


##  ⚙️ Installation

Clone the repository

Install dependencies:

composer install

Configure .env file

Set writable permissions:

chmod -R 777 writable/

Run project:

php spark serve



## 🔗 Routes

Add in app/Config/Routes.php:


$routes->get('filemanager', 'FileManager::index');
$routes->post('filemanager/upload', 'FileManager::upload');
$routes->get('filemanager/delete/(:segment)', 'FileManager::delete/$1');
$routes->get('filemanager/download/(:segment)', 'FileManager::download/$1');
$routes->get('filemanager/cleanup', 'FileManager::cleanup');
$routes->get('filemanager/zipbackup', 'FileManager::zipBackup');
$routes->get('filemanager/analytics', 'FileManager::analytics');


## 📤 File Upload Rules

Max Size: 2MB

Allowed Types:

png

jpg

jpeg

pdf

docx

txt

Validation handled via CI4 validation rules.

## 🗑️ Automatic Cleanup

Deletes files older than 7 days.

Setup Cron (Linux)

0 2 * * * php /path-to-project/public/index.php filemanager cleanup


Runs daily at 2 AM.


## 📦 ZIP Backup Feature

Creates compressed backup of uploads folder:


## 📊 Storage Analytics Dashboard

Displays:

Total Files

Total Storage Used (MB)

Average File Size (KB)

Helps monitor server storage usage.

## 🔐 Security Measures Implemented

basename() to prevent directory traversal

File extension whitelist

Max file size validation

Server-side validation rules

WRITEPATH usage instead of hardcoded paths

## 🧠 Possible Enhancements

Role-based authentication (Admin only)

AJAX drag-and-drop uploader

Chart-based analytics (Chart.js)

File renaming to random hashes

File versioning system

AWS S3 integration

Activity logging system

## 🧪 Testing Checklist

Upload allowed file types

Upload oversized file (should fail)

Try invalid file extension

Download file

Delete file

Run cleanup manually

Create ZIP backup

Check analytics dashboard values

