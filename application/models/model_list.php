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
}