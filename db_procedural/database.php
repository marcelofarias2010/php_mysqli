<?php

// Executa Querys
function DBExecute($query) {
    $link = DBConnect();
    $result = mysqli_query($link, $query) or die(mysqli_error($link));

    DBClose($link);
    return $result;
}

// Grava registros
function DBCreate($tabela, array $data) {
    $tabela = DB_PREFIX . '_' . $tabela;
    $data = DBEscape($data);
    $fields = implode(', ', array_keys($data));
    $values = "'" . implode("', '", $data) . "'";
    $query = "INSERT INTO {$tabela} ({$fields})"
            . "VALUES({$values})";

    return DBExecute($query);
}

// Ler Registros
function DBRead($tabela, $params = null, $fields = '*') {
    $tabela = DB_PREFIX . '_' . $tabela;
    $params = ($params) ? " {$params}" : null;
    $query = "SELECT {$fields} FROM {$tabela}{$params}";
    $result = DBExecute($query);

    //verifica se tem registro
    if (!mysqli_num_rows($result)) {
        return false;
    } else {
//        var_dump(mysqli_fetch_assoc($result));
        while ($res = mysqli_fetch_assoc($result)) {
            $data[] = $res;
        }
        return $data;
    }
}

// Altera Registros
function DBUpDate($tabela, array $data, $where = null){
    foreach ($data as $key => $value){
        $fields[] = "{$key} = '{$value}'";
    }
    $fields = implode(', ', $fields);
    
    $tabela = DB_PREFIX . '_' . $tabela;
    $where = ($where)? " WHERE {$where}" : null;
    $query = "UPDATE {$tabela} SET {$fields} {$where}";
    //var_dump($query);
    return DBExecute($query);
}

// Deletar Registros
function DBDelete($tabela, $where = null){
    $tabela = DB_PREFIX . '_' . $tabela;
    $where = ($where)? " WHERE {$where}" : null;
    $query = "DELETE FROM {$tabela} {$where}";
    return DBExecute($query);
}