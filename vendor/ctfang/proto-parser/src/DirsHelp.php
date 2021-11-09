<?php


namespace ProtoParser;


class DirsHelp
{
    /**
     * 获取所有文件列表
     *
     * @param  string  $path
     * @param  string|null  $ext
     * @return array
     */
    public static function getDirs(string $path, string $ext = null): array
    {
        $arr = [];
        if (is_dir($path)) {
            $dir = scandir($path);
            foreach ($dir as $value) {
                $sub_path = $path.'/'.$value;
                if ($value == '.' || $value == '..') {
                    continue;
                } else {
                    if (is_dir($sub_path)) {
                        $arr = array_merge($arr, self::getDirs($sub_path, $ext));
                    } else {
                        //.$path 可以省略，直接输出文件名
                        if ($ext === null || pathinfo($value, PATHINFO_EXTENSION) == $ext) {
                            $arr[] = $path.'/'.$value;
                        }
                    }
                }
            }
        }
        return $arr;
    }
}