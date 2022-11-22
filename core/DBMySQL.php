<?php

class DBMySQL extends Controller
{
    private $conn;
    private $showError = true;
    public $charset_set = 'utf8';

    public function __construct()
    {
        global $config;
        $this->conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS) or die('Error connecting to MySQL server');
        if ($this->conn) :
            mysqli_select_db($this->conn, DB_NAME) or die('Database Error');
            $this->query('SET NAMES ' . $this->charset_set);
        endif;
    }

    public function query($sql)
    {
        $s = $sql;
        $this->logMySQl($s);
        $sql = mysqli_query($this->conn, $sql);
        if (!$sql && $this->showError) {
            
        }
        return $sql;
    }

    public function insert($table, $data)
    {
        if (is_array($data)) :
            $fields = array_keys($data);
            $area = implode(',', $fields);
            $data = '\'' . implode("', '", array_map(array($this, 'escapeString'), $data)) . '\'';
        else :
            $parameters = func_get_args();
            $table = array_shift($parameters);
            $area = $data = null;
            $cparam = count($parameters) - 1;
            foreach ($parameters as $NO => $parameter) :
                $bol = explode('=', $parameter, 2);
                if ($cparam == $NO) :
                    $area .= $bol[0];
                    $data .= '\'' . $this->escapeString($bol[1]) . '\'';
                else :
                    $area .= $bol[0] . ',';
                    $data .= '\'' . $this->escapeString($bol[1]) . '\',';
                endif;
            endforeach;
        endif;

        $add = $this->query('INSERT INTO ' . $table . ' (' . $area . ') VALUES (' . $data . ')');
        if ($add) {
            return mysqli_insert_id($this->conn);
        }
    }

    public function table($sql)
    {
        $table = $this->query($sql);
        $result = array();
        while ($results = mysqli_fetch_object($table)) :
            $result[] = $results;
        endwhile;
        return $result;
    }

    public function row($sql)
    {
        $satir = $this->query($sql);
        if ($satir)
            return mysqli_fetch_object($satir);
    }

    public function field($sql)
    {
        $data = $this->query($sql);
        if ($data) :
            $result = mysqli_fetch_array($data, MYSQLI_NUM);
            return $result[0];
        endif;
    }

    public function delete($table, $condition = null)
    {
        if ($condition) :
            if (is_array($condition)) :
                $conditions = array();
                foreach ($condition as $area => $data)
                    $conditions[] = $area . '=\'' . $data . '\'';
            endif;
            return $this->query('DELETE FROM ' . $table . ' WHERE ' . (is_array($condition) ? implode(' AND ', $conditions) : $condition));
        else :
            return $this->query('TRUNCATE TABLE ' . $table);
        endif;
    }

    public function update($table, $value, $condition)
    {
        if (is_array($value)) :
            $values = array();
            foreach ($value as $area => $data)
                $values[] = $area . "='" . addslashes($data) . "'";
        endif;

        if (is_array($condition)) :
            $conditions = array();
            foreach ($condition as $area => $data)
                $conditions[] = $area . "='" . addslashes($data) . "'";
        endif;

        return $this->query('UPDATE ' . $table . ' SET ' . (is_array($value) ? implode(',', $values) : $value) . ' WHERE ' . (is_array($condition) ? implode(' AND ', $conditions) : $condition));
    }

    public function escapeString($data)
    {
        return $data;
    }
}
