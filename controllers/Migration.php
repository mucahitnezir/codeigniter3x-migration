<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->input->is_cli_request()) {
            echo "Execute via command line: php index.php migration";
            return;
        }

        $this->load->library('migration');
    }

    public function index()
    {
        $this->latest();
    }

    public function generate($name = false)
    {
        if (!$name) {
            echo "Please define migration name" . PHP_EOL;;
            return;
        }

        if (!preg_match('/^[a-z_]+$/i', $name)) {
            echo "Wrong migration name, allowed characters: a-z and _ \nExample: first_migration" . PHP_EOL;
            return;
        }

        $filename = date('YmdHis') .'_'. $name .'.php';
        try {
            $migrationsPath = APPPATH.'migrations';
            if (!is_dir($migrationsPath)) {
                try {
                    mkdir($migrationsPath);
                } catch (Exception $e) {
                    echo "Error:\n". $e->getMessage() . PHP_EOL;
                }
            }
            $filepath = $migrationsPath .'/'. $filename;
            if (file_exists($filepath)) {
                echo "File alredy exists:\n$filepath" . PHP_EOL;
                return;
            }

            $data["className"] = ucfirst($name);
            $template = $this->load->view("cli/migration/migration_class_template", $data, true);

            // Create File
            try {
                $file = fopen($filepath, "w");
                $content = "<?php\n" . $template;
                fwrite($file, $content);
                fclose($file);
            } catch (Exception $e) {
                echo "Error:\n". $e->getMessage() . PHP_EOL;
            }
            echo "Migration created successfully!\nLocation: ". $filepath . PHP_EOL;

        } catch (Exception $e) {
            echo "Can't create migration file:\nError: ". $e->getMessage() . PHP_EOL;
        }
    }

    public function version($version)
    {
        $migration = $this->migration->version($version);
        if (!$migration) {
            echo $this->migration->error_string();
        } else {
            echo 'Migration done'. PHP_EOL;
        }
    }

    public function latest()
    {
        $migrate = $this->migration->latest();
        if (!$migrate) {
            echo $this->migration->error_string();
        } else {
            echo 'Migration(s) done'. PHP_EOL;
        }
    }
}