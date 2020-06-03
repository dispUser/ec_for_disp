<?php
    function addImageRelationList($dbh, $item){
        for($i = 0; $i < count($item->imageEntityList); $i++){
            $imageEntity = $item->imageEntityList[$i];
            execInsertItemImageRelation($dbh, $item->code, $imageEntity);
        }
    }

    function execInsertItemImageRelation($dbh, $item_code, $imageEntity){
        $sql =  'INSERT INTO 
                    rel_product_image
                        (
                            product_code
                            , image_code
                        ) 
                 VALUES
                    (
                        ?
                        ,?
                    )';
        $stmt = $dbh->prepare($sql);
        $data = array();
        $data[] = $item_code;
        $data[] = $imageEntity->code;
        $stmt->execute($data);
    }
?>