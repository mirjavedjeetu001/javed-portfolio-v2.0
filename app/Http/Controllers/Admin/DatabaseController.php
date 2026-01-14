<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;

class DatabaseController extends AdminController
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        // Get list of backup files
        $backups = [];
        if (Storage::disk('local')->exists('backups')) {
            $files = Storage::disk('local')->files('backups');
            foreach ($files as $file) {
                if (pathinfo($file, PATHINFO_EXTENSION) === 'sql') {
                    $backups[] = [
                        'name' => basename($file),
                        'path' => $file,
                        'size' => Storage::disk('local')->size($file),
                        'date' => Storage::disk('local')->lastModified($file)
                    ];
                }
            }
            // Sort by date, newest first
            usort($backups, function($a, $b) {
                return $b['date'] - $a['date'];
            });
        }

        return view('admin.database.index', compact('backups'));
    }

    public function export()
    {
        try {
            // Create backups directory if not exists
            if (!Storage::disk('local')->exists('backups')) {
                Storage::disk('local')->makeDirectory('backups');
            }

            $filename = 'backup_' . date('Y-m-d_His') . '.sql';
            $filepath = storage_path('app/backups/' . $filename);

            // Always use PHP export method for reliability
            $this->exportDatabasePHP($filepath);

            if (file_exists($filepath) && filesize($filepath) > 0) {
                return response()->download($filepath, $filename, [
                    'Content-Type' => 'application/sql',
                    'Content-Disposition' => 'attachment; filename="' . $filename . '"'
                ])->deleteFileAfterSend(false);
            }

            return redirect()->route('admin.database.index')->with('error', 'Export failed: Could not generate backup file');
        } catch (\Exception $e) {
            \Log::error('Database export failed: ' . $e->getMessage());
            return redirect()->route('admin.database.index')->with('error', 'Export failed: ' . $e->getMessage());
        }
    }

    public function import(Request $request)
    {
        $request->validate([
            'sql_file' => 'required|file|mimes:sql,txt|max:51200' // 50MB max
        ]);

        try {
            $file = $request->file('sql_file');
            $sql = file_get_contents($file->getRealPath());

            DB::unprepared($sql);

            return back()->with('success', 'Database imported successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Import failed: ' . $e->getMessage());
        }
    }

    public function restore($filename)
    {
        try {
            $filepath = storage_path('app/backups/' . $filename);

            if (!file_exists($filepath)) {
                return back()->with('error', 'Backup file not found!');
            }

            $sql = file_get_contents($filepath);
            DB::unprepared($sql);

            return back()->with('success', 'Database restored successfully from: ' . $filename);
        } catch (\Exception $e) {
            return back()->with('error', 'Restore failed: ' . $e->getMessage());
        }
    }

    public function delete($filename)
    {
        try {
            $filepath = 'backups/' . $filename;
            
            if (Storage::disk('local')->exists($filepath)) {
                Storage::disk('local')->delete($filepath);
                return back()->with('success', 'Backup deleted successfully!');
            }

            return back()->with('error', 'Backup file not found!');
        } catch (\Exception $e) {
            return back()->with('error', 'Delete failed: ' . $e->getMessage());
        }
    }

    private function exportDatabasePHP($filepath)
    {
        try {
            $dbName = env('DB_DATABASE');
            $tables = DB::select('SHOW TABLES');
            
            $sql = "-- Database Export\n";
            $sql .= "-- Generated: " . date('Y-m-d H:i:s') . "\n";
            $sql .= "-- Database: " . $dbName . "\n\n";
            $sql .= "SET FOREIGN_KEY_CHECKS=0;\n";
            $sql .= "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\n";
            $sql .= "SET time_zone = \"+00:00\";\n\n";

            foreach ($tables as $table) {
                // Get table name from the result
                $tableArray = (array) $table;
                $tableName = reset($tableArray);
                
                // Drop table
                $sql .= "\n-- Table structure for `{$tableName}`\n";
                $sql .= "DROP TABLE IF EXISTS `{$tableName}`;\n";
                
                // Create table
                $createTable = DB::select("SHOW CREATE TABLE `{$tableName}`");
                $createTableArray = (array) $createTable[0];
                $sql .= $createTableArray['Create Table'] . ";\n";
                
                // Insert data
                $rows = DB::table($tableName)->get();
                if ($rows->count() > 0) {
                    $sql .= "\n-- Dumping data for table `{$tableName}`\n";
                    foreach ($rows as $row) {
                        $values = [];
                        foreach ((array)$row as $value) {
                            if (is_null($value)) {
                                $values[] = 'NULL';
                            } else {
                                $values[] = "'" . str_replace("'", "''", $value) . "'";
                            }
                        }
                        $sql .= "INSERT INTO `{$tableName}` VALUES (" . implode(', ', $values) . ");\n";
                    }
                }
                $sql .= "\n";
            }

            $sql .= "SET FOREIGN_KEY_CHECKS=1;\n";

            file_put_contents($filepath, $sql);
            
            return true;
        } catch (\Exception $e) {
            \Log::error('Database export failed: ' . $e->getMessage());
            throw $e;
        }
    }
}
