<?php

class Model
{
    public static function get_conection()
    {
        return new Conection();
    }

    public static function get_pid()
    {
        $data = random_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    public static function create_object(array $fields_data)
    {
        foreach ($fields_data as $field => $field_value) {
            $fields_names[]              =       $field;             
            $drive_options[':' . $field] = $field_value;
        }
        $fields_names_string =       implode(',', $fields_names);
        $fields_ids          = ':' . implode(',:', $fields_names);
        try {
            $conection = self::get_conection();
            $data      = $conection->query_execute(
                "INSERT INTO " . get_called_class() .
                    "(" . $fields_names_string . ") VALUES (" . $fields_ids . ")",
                $drive_options
            );
            return $data;
        } catch (\Throwable $th) {
            die($th);
        }
    }

    // public static function get_object($pid)
    // {
    //     $conection = self::get_conection();
    //     $obj = $conection->query("SELECT * FROM " . self::class);
    //     return $obj;
    // }
}
