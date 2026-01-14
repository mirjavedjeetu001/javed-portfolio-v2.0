<?php
/**
 * Laravel Installation Helper for cPanel
 * 
 * This file helps you complete Laravel installation on cPanel hosting
 * Visit: https://yourdomain.com/install-helper.php
 * 
 * ⚠️ DELETE THIS FILE AFTER INSTALLATION!
 */

$basePath = dirname(__DIR__);
$errors = [];
$success = [];
$warnings = [];

// Check if installation is needed
if (file_exists($basePath . '/.env') && !empty(env('APP_KEY'))) {
    $warnings[] = 'Laravel appears to be already configured. Be careful!';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Installation Helper</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px;
            text-align: center;
        }
        .header h1 { font-size: 32px; margin-bottom: 10px; }
        .header p { opacity: 0.9; }
        .content { padding: 40px; }
        .section {
            margin-bottom: 30px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            border-left: 4px solid #667eea;
        }
        .section h2 {
            color: #667eea;
            margin-bottom: 15px;
            font-size: 20px;
        }
        .check-item {
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
            display: flex;
            align-items: center;
        }
        .check-item.success {
            background: #d4edda;
            border-left: 4px solid #28a745;
        }
        .check-item.error {
            background: #f8d7da;
            border-left: 4px solid #dc3545;
        }
        .check-item.warning {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
        }
        .icon {
            margin-right: 10px;
            font-size: 20px;
        }
        .btn {
            display: inline-block;
            padding: 15px 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-weight: bold;
            margin: 10px 5px;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        .btn:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0,0,0,0.2); }
        .code {
            background: #2d2d2d;
            color: #f8f8f2;
            padding: 15px;
            border-radius: 8px;
            overflow-x: auto;
            font-family: 'Courier New', monospace;
            font-size: 14px;
            margin: 10px 0;
        }
        .alert {
            padding: 15px;
            margin: 20px 0;
            border-radius: 8px;
            font-weight: bold;
        }
        .alert-danger {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
            margin: 20px 0;
        }
        .info-card {
            background: white;
            padding: 15px;
            border-radius: 8px;
            border: 2px solid #e9ecef;
        }
        .info-card strong { display: block; color: #667eea; margin-bottom: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🚀 Laravel Installation Helper</h1>
            <p>Complete your Laravel deployment on cPanel</p>
        </div>
        
        <div class="content">
            <div class="alert alert-danger">
                ⚠️ <strong>IMPORTANT:</strong> Delete this file (install-helper.php) after installation is complete!
            </div>

            <?php
            // 1. PHP Version Check
            echo '<div class="section">';
            echo '<h2>1. PHP Environment</h2>';
            
            $phpVersion = PHP_VERSION;
            $requiredVersion = '8.1.0';
            
            if (version_compare($phpVersion, $requiredVersion, '>=')) {
                echo '<div class="check-item success"><span class="icon">✅</span>PHP Version: ' . $phpVersion . ' (Required: 8.1+)</div>';
            } else {
                echo '<div class="check-item error"><span class="icon">❌</span>PHP Version: ' . $phpVersion . ' - Upgrade to PHP 8.1+ required!</div>';
                $errors[] = 'PHP version too old';
            }
            
            // Required Extensions
            $requiredExtensions = ['pdo', 'mbstring', 'openssl', 'tokenizer', 'xml', 'ctype', 'json', 'bcmath', 'fileinfo'];
            foreach ($requiredExtensions as $ext) {
                if (extension_loaded($ext)) {
                    echo '<div class="check-item success"><span class="icon">✅</span>Extension: ' . $ext . '</div>';
                } else {
                    echo '<div class="check-item error"><span class="icon">❌</span>Extension: ' . $ext . ' - Missing!</div>';
                    $errors[] = 'Missing extension: ' . $ext;
                }
            }
            echo '</div>';
            
            // 2. Directory Permissions
            echo '<div class="section">';
            echo '<h2>2. Directory Permissions</h2>';
            
            $checkDirs = [
                'storage' => $basePath . '/storage',
                'storage/framework' => $basePath . '/storage/framework',
                'storage/logs' => $basePath . '/storage/logs',
                'bootstrap/cache' => $basePath . '/bootstrap/cache',
            ];
            
            foreach ($checkDirs as $name => $dir) {
                if (is_dir($dir) && is_writable($dir)) {
                    echo '<div class="check-item success"><span class="icon">✅</span>' . $name . ' - Writable</div>';
                } else {
                    echo '<div class="check-item error"><span class="icon">❌</span>' . $name . ' - Not writable! (chmod 775)</div>';
                    $errors[] = $name . ' not writable';
                }
            }
            echo '</div>';
            
            // 3. .env File Check
            echo '<div class="section">';
            echo '<h2>3. Environment Configuration</h2>';
            
            $envPath = $basePath . '/.env';
            if (file_exists($envPath)) {
                echo '<div class="check-item success"><span class="icon">✅</span>.env file exists</div>';
                
                // Check important settings
                $envContent = file_get_contents($envPath);
                
                if (strpos($envContent, 'APP_KEY=base64:') !== false) {
                    echo '<div class="check-item success"><span class="icon">✅</span>APP_KEY is set</div>';
                } else {
                    echo '<div class="check-item error"><span class="icon">❌</span>APP_KEY not set</div>';
                    echo '<div class="code">php artisan key:generate</div>';
                    $errors[] = 'APP_KEY not set';
                }
                
                if (strpos($envContent, 'APP_DEBUG=false') !== false) {
                    echo '<div class="check-item success"><span class="icon">✅</span>APP_DEBUG=false (Production mode)</div>';
                } else {
                    echo '<div class="check-item warning"><span class="icon">⚠️</span>APP_DEBUG should be false in production!</div>';
                    $warnings[] = 'APP_DEBUG should be false';
                }
                
                // Database check
                preg_match('/DB_DATABASE=(.*)/', $envContent, $dbName);
                preg_match('/DB_USERNAME=(.*)/', $envContent, $dbUser);
                
                if (!empty($dbName[1]) && $dbName[1] !== 'laravel') {
                    echo '<div class="check-item success"><span class="icon">✅</span>Database configured: ' . trim($dbName[1]) . '</div>';
                } else {
                    echo '<div class="check-item error"><span class="icon">❌</span>Database not configured in .env</div>';
                    $errors[] = 'Database not configured';
                }
                
            } else {
                echo '<div class="check-item error"><span class="icon">❌</span>.env file not found</div>';
                echo '<div class="code">cp .env.example .env</div>';
                $errors[] = '.env file missing';
            }
            echo '</div>';
            
            // 4. Storage Link
            echo '<div class="section">';
            echo '<h2>4. Storage Link</h2>';
            
            $storageLink = $basePath . '/public/storage';
            if (is_link($storageLink) || is_dir($storageLink)) {
                echo '<div class="check-item success"><span class="icon">✅</span>Storage link exists</div>';
            } else {
                echo '<div class="check-item error"><span class="icon">❌</span>Storage link not created</div>';
                echo '<div class="code">php artisan storage:link</div>';
                $errors[] = 'Storage link missing';
            }
            echo '</div>';
            
            // 5. System Information
            echo '<div class="section">';
            echo '<h2>5. System Information</h2>';
            echo '<div class="info-grid">';
            echo '<div class="info-card"><strong>PHP Version:</strong>' . PHP_VERSION . '</div>';
            echo '<div class="info-card"><strong>Server Software:</strong>' . ($_SERVER['SERVER_SOFTWARE'] ?? 'Unknown') . '</div>';
            echo '<div class="info-card"><strong>Document Root:</strong>' . ($_SERVER['DOCUMENT_ROOT'] ?? 'Unknown') . '</div>';
            echo '<div class="info-card"><strong>Current Directory:</strong>' . __DIR__ . '</div>';
            echo '</div>';
            echo '</div>';
            
            // 6. Action Buttons
            echo '<div class="section">';
            echo '<h2>6. Quick Actions</h2>';
            
            if (isset($_GET['action'])) {
                $action = $_GET['action'];
                
                switch ($action) {
                    case 'generate_key':
                        if (file_exists($envPath)) {
                            $key = 'base64:' . base64_encode(random_bytes(32));
                            $envContent = file_get_contents($envPath);
                            $envContent = preg_replace('/APP_KEY=.*/', 'APP_KEY=' . $key, $envContent);
                            
                            if (file_put_contents($envPath, $envContent)) {
                                echo '<div class="check-item success"><span class="icon">✅</span>APP_KEY generated successfully!</div>';
                                echo '<div class="code">' . $key . '</div>';
                            } else {
                                echo '<div class="check-item error"><span class="icon">❌</span>Failed to write to .env file. Check permissions.</div>';
                            }
                        }
                        break;
                        
                    case 'storage_link':
                        $target = $basePath . '/storage/app/public';
                        $link = $basePath . '/public/storage';
                        
                        if (!file_exists($link)) {
                            if (symlink($target, $link)) {
                                echo '<div class="check-item success"><span class="icon">✅</span>Storage link created successfully!</div>';
                            } else {
                                echo '<div class="check-item error"><span class="icon">❌</span>Failed to create storage link. Use SSH: php artisan storage:link</div>';
                            }
                        } else {
                            echo '<div class="check-item warning"><span class="icon">⚠️</span>Storage link already exists</div>';
                        }
                        break;
                        
                    case 'test_db':
                        if (file_exists($envPath)) {
                            $env = parse_ini_file($envPath);
                            $host = $env['DB_HOST'] ?? 'localhost';
                            $db = $env['DB_DATABASE'] ?? '';
                            $user = $env['DB_USERNAME'] ?? '';
                            $pass = $env['DB_PASSWORD'] ?? '';
                            
                            try {
                                $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
                                echo '<div class="check-item success"><span class="icon">✅</span>Database connection successful!</div>';
                                echo '<div class="code">Connected to: ' . $db . '</div>';
                            } catch (PDOException $e) {
                                echo '<div class="check-item error"><span class="icon">❌</span>Database connection failed!</div>';
                                echo '<div class="code">' . $e->getMessage() . '</div>';
                            }
                        }
                        break;
                }
                
                echo '<br><a href="install-helper.php" class="btn">← Back to Checks</a>';
            } else {
                ?>
                <p style="margin-bottom: 15px;">Click the buttons below to perform installation tasks:</p>
                <a href="?action=generate_key" class="btn">🔑 Generate APP_KEY</a>
                <a href="?action=storage_link" class="btn">🔗 Create Storage Link</a>
                <a href="?action=test_db" class="btn">🗄️ Test Database Connection</a>
                <?php
            }
            echo '</div>';
            
            // 7. Summary
            echo '<div class="section">';
            if (empty($errors)) {
                echo '<div class="check-item success">';
                echo '<span class="icon">🎉</span>';
                echo '<strong>All checks passed! Your Laravel application is ready.</strong>';
                echo '</div>';
                echo '<p style="margin-top: 15px;">Next steps:</p>';
                echo '<ol style="margin-left: 20px; line-height: 2;">';
                echo '<li>Visit your website homepage</li>';
                echo '<li>Login to admin panel at: /admin/login</li>';
                echo '<li><strong>DELETE this file (install-helper.php)</strong></li>';
                echo '</ol>';
            } else {
                echo '<div class="check-item error">';
                echo '<span class="icon">⚠️</span>';
                echo '<strong>Found ' . count($errors) . ' error(s). Please fix them before proceeding.</strong>';
                echo '</div>';
            }
            
            if (!empty($warnings)) {
                echo '<div class="check-item warning">';
                echo '<span class="icon">⚠️</span>';
                echo '<strong>' . count($warnings) . ' warning(s) - Please review</strong>';
                echo '</div>';
            }
            echo '</div>';
            ?>
            
            <div style="text-align: center; padding: 20px; background: #fff3cd; border-radius: 10px; margin-top: 20px;">
                <h3 style="color: #856404; margin-bottom: 10px;">⚠️ Security Warning</h3>
                <p style="color: #856404;">This file exposes sensitive information about your installation.</p>
                <p style="color: #856404; font-weight: bold; margin-top: 10px;">DELETE THIS FILE IMMEDIATELY AFTER INSTALLATION!</p>
            </div>
        </div>
    </div>
</body>
</html>
