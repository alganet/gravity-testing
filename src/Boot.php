<?php

namespace Supercluster\Gravity;

class Boot extends Container
{
    protected $env       = ".lock";
    protected $extension = ".ini";
    protected $file      = "supercluster";
    protected $folder    = ".";
    protected $front     = "application";

    public function __construct($env)
    {
        $this->loadEnvironment($env);
    }

    public function __invoke($spec = null)
    {
        $front = $this->{$this->front};
        $this->exchangeArray(array());
        return $front->run();
    }

    public function loadEnvironment($env)
    {
        if (!empty($env)) {
            $this->env =  "." . filter_var($env, FILTER_SANITIZE_STRING);
        }
        $file = "{$this->folder}/{$this->file}{$this->env}{$this->extension}";

        if (!file_exists($file)) {
            return; // No environment available.
        }

        $bootFiles = parse_ini_file($file, true);

        if (!isset($bootFiles['boot'])) {
            return;
        }

        foreach ($bootFiles['boot'] as $booted) {
            $bootedFiles = parse_ini_file($booted, true);
            if (!isset($bootedFiles['load'])) {
                continue;
            }

            foreach ($bootedFiles['load'] as $bootLoad) {
                $this->loadFile(dirname($booted) . DIRECTORY_SEPARATOR . $bootLoad);
            }
        }

        foreach ($bootFiles['load'] as $loaded) {
            $this->loadFile($loaded);
        }
    }
}
