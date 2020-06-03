<?php

    //FIXME: 商品ごとのランキング。画像ごとにしなくてもよい？
    // まあ、何色が売れようが、商品でまとめて１つとして扱ってもいいけど。
    function execInsertRanking($dbh, $item){
        $sql =  'INSERT INTO dat_ranking
                    (
                        sell_count
                        , pro_code
                    ) 
                VALUES
                    (
                        ?
                        ,?
                    )';
        $stmt = $dbh->prepare($sql);
        $data = array();
        $data[] = 0;
        $data[] = $item->code;
        $stmt->execute($data);
    }


    function execUpdateRanking($dbh, $cartItem){
            $sql =  'UPDATE 
                        dat_ranking 
                     SET 
                        sell_count = 
                        (
                            SELECT
                                sell_count
                            FROM
                                (
                                    SELECT
                                        (sell_count + ?) as sell_count
                                    FROM
                                        dat_ranking
                                    WHERE
                                        pro_code = ?
                                ) AS avoidError
                        )
                      WHERE 
                        pro_code = ?';

            $stmt = $dbh->prepare($sql);
            $data = array();
            $data[] = $cartItem->quantity;;
            $data[] = $cartItem->code;
            $data[] = $cartItem->code;
            $stmt->execute($data);
    }
?>