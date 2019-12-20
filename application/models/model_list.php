<?php


class Model_list extends Model
{
    public function getListApps(){
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "SELECT lapps.id, lapps.descr, lapps.datebeg, lapps.dateend, "
            ."lapps.userid, lapps.fixed, users.desc FROM efko.lapps LEFT JOIN efko.users ON lapps.userid = users.id ORDER BY lapps.id";
        $st = $conn->prepare($sql);
        $st->execute();
        $list = array();
        while($row = $st->fetch()){
            $list[] = $row;
        }
        $conn = null;
        return $list;
    }

    public function getById($id){
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "SELECT * "
            . "FROM lapps WHERE id = :id";
        $st = $conn->prepare($sql);
        $st->bindValue(":id", $id, PDO::PARAM_INT);
        $st->execute();
        $row = $st->fetch();
        $conn = null;
        if ($row) {
            return $row;
        }
    }

    public function insert($data){
        if (!is_null($data['id']) ) trigger_error ( "LeaveApplication::insert(): Объект с таким ID уже есть в базе: {$data['id']}).", E_USER_ERROR );
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "INSERT INTO lapps (descr, datebeg, dateend, userid, fixed) VALUES (:descr, FROM_UNIXTIME(:datebeg), FROM_UNIXTIME(:dateend), :userid, :fixed)";
        $st = $conn->prepare ($sql);
        $st->bindValue( ":descr", $data['descr'], PDO::PARAM_STR);
        $st->bindValue(":datebeg", self::createDate($data['datebeg']), PDO::PARAM_INT);
        $st->bindValue(":dateend", self::createDate($data['dateend']), PDO::PARAM_INT);
        $st->bindValue(":fixed", $data['fixed'], PDO::PARAM_INT);
        $st->bindValue( ":userid", $data['userid'], PDO::PARAM_INT );
        $st->execute();
        $data['id'] = $conn->lastInsertId();
        $conn = null;
    }

    public function update($data){
        if (is_null($data['id'])) trigger_error ( "LeaveApplication::update(): "
            . "Для объекта не задан идентификатор", E_USER_ERROR );
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "UPDATE lapps SET descr=:descr, datebeg=FROM_UNIXTIME(:datebeg), dateend=FROM_UNIXTIME(:dateend), fixed=:fixed WHERE id = :id";
        $st = $conn->prepare ($sql);
        $st->bindValue( ":descr", $data['descr'], PDO::PARAM_STR);
        $st->bindValue(":datebeg", self::createDate($data['datebeg']), PDO::PARAM_INT);
        $st->bindValue(":dateend", self::createDate($data['dateend']), PDO::PARAM_INT);
        $st->bindValue(":fixed", $data['fixed'], PDO::PARAM_INT);
        $st->bindValue(":id", $data['id'], PDO::PARAM_INT);
        $st->execute();
        $conn = null;
    }

    public function delete($id){
        if (is_null($id))
            trigger_error("LeaveApplication::delete(): "
                . "Для объекта не задан идентификатор", E_USER_ERROR);
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $st = $conn->prepare("DELETE FROM lapps WHERE id = :id LIMIT 1");
        $st->bindValue(":id", $id, PDO::PARAM_INT);
        $st->execute();
        $conn = null;
    }

    private static function createDate($date){
        return date_timestamp_get(date_create($date));
    }
}