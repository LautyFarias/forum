<?php

class Model
{
    private $table;

    private function get_conection()
    {
        $this->table = get_called_class();
        return new Conection();
    }

    protected function get_pid()
    {
        $data = random_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    protected function create_object(array $fields_data)
    {
        foreach ($fields_data as $field => $field_value) {
            $fields_names[]              =       $field;
            $drive_options[':' . $field] = $field_value;
        }
        $fields_names_string =       implode(',', $fields_names);
        $fields_ids          = ':' . implode(',:', $fields_names);
        try {
            $conection = $this->get_conection();
            $res = $conection->query_execute(
                "INSERT INTO " . $this->table .
                    "(" . $fields_names_string . ") VALUES (" . $fields_ids . ")",
                $drive_options
            );
            return $res;
        } catch (\Throwable $th) {
            http_response_code(500);
            return false;
        }
    }

    protected function get_object(array $field)
    {
        $where_data = $this->get_condition($field);
        $conection  = $this->get_conection();
        $obj = $conection->query_execute(
            "SELECT * FROM " . $this->table . " WHERE " . $where_data['condition'],
            $where_data['drive_options']
        );
        return $obj;
    }

    private function get_condition(array $fields)
    {
        foreach ($fields as $field => $field_value) {
            $where_data[]                = $field . '=:' . $field;
            $drive_options[':' . $field] = $field_value;
        }
        $where_data_string = implode(' and ', $where_data);
        return [
            "condition"     => $where_data_string,
            "drive_options" => $drive_options
        ];
    }

    public function update_object(array $field, array $options = [])
    {
        $where_data            = $this->get_condition($options);
        $fields_to_update_data = $this->get_update_data($field);
        $conection             = $this->get_conection();

        $drive_options = array_merge(
            $fields_to_update_data['drive_options'],
            $where_data['drive_options']
        );
        $res = $conection->query_execute(
            "UPDATE " . $this->table . " SET " . $fields_to_update_data['update_set']
                . " WHERE " . $where_data['condition'],
            $drive_options
        );
        return $res;
    }

    private function get_update_data(array $fields)
    {
        foreach ($fields as $field => $field_value) {
            $update_set[]                = $field . '=:' . $field;
            $drive_options[':' . $field] = $field_value;
        }
        $update_set_string = implode(',', $update_set);
        return [
            "update_set"    => $update_set_string,
            "drive_options" => $drive_options
        ];
    }

    public function get_objects()
    {
        $conection  = $this->get_conection();
        $objs = $conection->query_execute(
            "SELECT * FROM " . $this->table
        );
        return $objs;
    }

    protected function get_field(string $field, $condition)
    {
        $conection  = $this->get_conection();
        if (is_null($condition)) {
            $obj = $conection->query_execute(
                "SELECT " . $field .  " FROM " . $this->table
            );
            return $obj;
        }

        $where_data = $this->get_condition($condition);
        $obj = $conection->query_execute(
            "SELECT" . $field . "FROM " . $this->table
            . " WHERE " . $where_data['condition'],
            $where_data['drive_options']
        );
        return $obj;
    }
}
