<?php
    class Member {
        public $code;
        public $date;
        public $password;
        public $name;
        public $email;
        public $postal1;
        public $postal2;
        public $address;
        public $tel;
    }

    class MemberQuery{
        static $base_select_query = "SELECT
                                        code
                                        , date
                                        , password
                                        , name
                                        , email
                                        , postal1
                                        , postal2
                                        , address
                                        , tel
                                    FROM 
                                        dat_member";
        static $select_last_insert_id_query = "SELECT
                                            LAST_INSERT_ID() AS id 
                                        FROM 
                                            dat_member";
    }

    function execSelectMember($where, $orderBy){
        try{
            // DBアクセス
            $dbh = new PDO(Con::$dsn, Con::$user, Con::$password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = MemberQuery::$base_select_query
                    . " " . $where
                    . " " . $orderBy;
            
            $stmt = $dbh->prepare($sql);
            $stmt->execute();

            // DB切断
            $dbh = null;

            $memberList = setMemberEntity($stmt);

            return $memberList;

        }catch(Exception $e){
            print 'DB ERROR';
            exit();
        }
    }

    function setMemberEntity($stmt){
        $memberList = array();

        while(true){
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            if($rec == false){
                break;
            }
            $member = new Member;
            $member->code = $rec['code'];
            $member->date = $rec['date'];
            $member->password = $rec['password'];
            $member->name = $rec['name'];
            $member->email = $rec['email'];
            $member->postal1 = $rec['postal1'];
            $member->postal2 = $rec['postal2'];
            $member->address = $rec['address'];
            $member->tel = $rec['tel'];
            array_push($memberList, $member);
        }

        return $memberList;
    }

    function execInsertMember($dbh, $member){
        // let others to make connection, tran control
            $sql = 'INSERT INTO 
                        dat_member
                        (
                            password
                            , name
                            , email
                            , postal1
                            , postal2
                            , address
                            , tel
                        ) 
                    VALUES
                        (
                            ?
                            ,?
                            ,?
                            ,?
                            ,?
                            ,?
                            ,?
                        )';
            $stmt = $dbh->prepare($sql);
            $data = array();
            $data[] = encrypt($member->password);
            $data[] = $member->name;
            $data[] = $member->email;
            $data[] = $member->postal1;
            $data[] = $member->postal2;
            $data[] = $member->address;
            $data[] = $member->tel;
            $stmt->execute($data);

            // get last insert id
            $sql = MemberQuery::$select_last_insert_id_query;
            $stmt = $dbh->prepare($sql);
            $stmt->execute($data);
            
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            $last_insert_id = $rec['id'];
            
            return $last_insert_id;
    }

    function getEmail($email){
        $where = "WHERE 
                    email = '" . $email . "'";
        $orderBy = "";

        $memberList = execSelectMember($where, $orderBy);

        return $memberList;
    }

    function getMemberByEmailAndPass($email, $pass){
        $encrypt_pass = encrypt($pass);
        $where = "WHERE
                    email = '" . $email . "'" .
                 " AND
                    password = '" . $encrypt_pass . "'";
        $orderBy = "";
        $memberList = execSelectMember($where, $orderBy);
        return $memberList;
    }

    function getMemberByCode($member_code){
        $where = "WHERE
                    code = " . $member_code;
        $orderBy = "ORDER BY
                        date desc";
        $memberList = execSelectMember($where, $orderBy);
        return $memberList;
    }

    function getAllMemberList(){
        $where = "";
        $orderBy = "ORDER BY
                        date desc";
        $memberList = execSelectMember($where, $orderBy);
        return $memberList;
    }

    function execUpdateMember($memberInfo){
        try{
            // DBアクセス
            $dbh = new PDO(Con::$dsn, Con::$user, Con::$password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            // SQL実行(prepared statement なので安全)
            $sql =  'UPDATE 
                        dat_member 
                    SET 
                        name = ?
                        , email = ? 
                        , postal1 = ? 
                        , postal2 = ? 
                        , address = ?';
            if(isset($memberInfo->password) && $memberInfo->password != ''){
                $sql = $sql . ', password = ?'; 
            }       
            $sql = $sql . ' WHERE 
                            code = ?';            
            $stmt = $dbh->prepare($sql);
            $data[] = $memberInfo->name;
            $data[] = $memberInfo->email;
            $data[] = $memberInfo->postal1;
            $data[] = $memberInfo->postal2;
            $data[] = $memberInfo->address;
            if($memberInfo->password != ''){
                $data[] = $memberInfo->password;
            }
            $data[] = $memberInfo->code;
            $stmt->execute($data);
    
            // DB切断
            $dbh = null;
        
        }catch(Exception $e){
            print 'ただいま障害により大変ご迷惑をお掛けしております。';
            exit();
        }
    }
?>