<?php
    class Staff{
        public $code;
        public $name;
        public $password;
    }

    function execUpdateStaff($staff){
        try{
            // DBアクセス
            $dbh = new PDO(Con::$dsn, Con::$user, Con::$password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            // SQL実行(prepared statement なので安全)
            $sql =  "UPDATE 
                        mst_staff
                    SET
                        name = ?
                        , password = ?
                    WHERE
                        code = ?";
            $data = array();
            $data[] = $staff->name;
            $data[] = encrypt($staff->password);
            $data[] = $staff->code;
            $stmt = $dbh->prepare($sql);
            $stmt->execute($data);
    
            // DB切断
            $dbh = null;

        }
        catch(Exception $e){
            print 'Fatal Error';
            exit();
        }
    }

    function execInsert($name, $password){
        $enc_pass = encrypt($password);

        try{
            // DBアクセス
            $dbh = new PDO(Con::$dsn, Con::$user, Con::$password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            // SQL実行(prepared statement なので安全)
            $sql =  "INSERT 
                        INTO 
                        mst_staff
                        (
                            name
                            , password
                        ) 
                        VALUES
                        (
                            ?
                            ,?
                        )";
            $stmt = $dbh->prepare($sql);
            $data[] = $name;
            $data[] = $enc_pass;
            $stmt->execute($data);
    
            // DB切断
            $dbh = null;

        }
        catch(Exception $e){
            print 'Fatal Error';
            exit();
        }
    }

    function execSelectStaff($where, $orderBy){
        try{
            // DBアクセス
            $dbh = new PDO(Con::$dsn, Con::$user, Con::$password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            // SQL実行(prepared statement なので安全)
            $sql =  "SELECT 
                        code
                        , name
                        , password 
                    FROM 
                        mst_staff"
                    . " " . $where 
                    . " " . $orderBy
                    ;
            $stmt = $dbh->prepare($sql);
            $stmt->execute();
    
            // DB切断
            $dbh = null;
    
            $staffList = setStaffEntity($stmt);

            return $staffList;
        }
        catch(Exception $e){
            print 'Fatal Error';
            exit();
        }
    }

    function setStaffEntity($stmt){
        $staffList = array();

        while(true){
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            if($rec == false){
                break;
            }
            $staff = new Staff;
            $staff->code = $rec['code'];
            $staff->name = $rec['name'];
            $staff->password = $rec['password'];
            array_push($staffList, $staff);
        }

        return $staffList;
    }

    function getAllStaffList(){
        $where = "";
        $orderBy = "";

        $staffList = execSelectStaff($where, $orderBy);

        return $staffList;
    }

    function getStaffByCode($staff_code){
        $where = "WHERE 
                    code = " . $staff_code;
        $orderBy = "";

        $staffList = execSelectStaff($where, $orderBy);

        return $staffList;
    }

    function getStaffByCodeAndPass($staff_code, $staff_pass){
        $encrypt_staff_pass = encrypt($staff_pass);

        $where = "WHERE 
                    code = " . $staff_code . " " .
                 "AND 
                    password = '" . $encrypt_staff_pass . "'";
        $orderBy = "";

        $staffList = execSelectStaff($where, $orderBy);

        return $staffList;
    }
?>