<?php
    class Image{
        public $code;
        public $file_name;
    }

    function execUpdateImage($item){
        try{
            // DBアクセス
            $dbh = new PDO(Con::$dsn, Con::$user, Con::$password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            // SQL実行(prepared statement なので安全)
            $sql =  'UPDATE 
                        mst_image 
                    SET 
                        file_name = ? 
                    WHERE 
                        code = ?';
            $stmt = $dbh->prepare($sql);
            $data = array();
            $data[] = $item->code.$item->file_name;
            $data[] = $item->image_code;
            $stmt->execute($data);
    
            // DB切断
            $dbh = null;
    
        }
        catch(Exception $e){
            print 'Fatal Error';
            exit();
        }
    }

    function addImageList($dbh, $item){
        for($i = 0; $i < count($item->imageEntityList); $i++){
            $unique_key = $item->code . $i;
            $imageEntity = $item->imageEntityList[$i];
            execInsertImage($dbh, $unique_key, $imageEntity);
        }
    }

    function execInsertImage($dbh, $unique_key, $imageEntity){
        $sql =  'INSERT INTO 
                    mst_image
                        (
                            file_name
                        ) 
                    VALUES
                        (
                            ?
                        )';
        $stmt = $dbh->prepare($sql);
        $data = array();
        $data[] = $unique_key . $imageEntity->file_name;
        $stmt->execute($data);

        // 商品画像にコードを設定
        $sql =  'SELECT LAST_INSERT_ID() from mst_image';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        $imageEntity->code = $rec["LAST_INSERT_ID()"];
    }
?>