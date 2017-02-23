<?php


class ComposerHook
{
    public static function generateConfig()
    {
        $iniArray = parse_ini_file(__DIR__."/../build.ini");
        $configTemplateFile = __DIR__."/Config.php.dist";
        $configFile = __DIR__."/Config.php";

        if (!copy ($configTemplateFile, $configFile)) {
            echo "Error generating config file\n";
            die;
        }
        $file_contents = file_get_contents($configFile);
        foreach ($iniArray as $name => $value) {
            $file_contents = str_replace("%{$name}%",$value, $file_contents);
        }
        file_put_contents($configFile, $file_contents);
    }
}