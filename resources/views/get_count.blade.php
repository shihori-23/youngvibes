<?php
//DB接続
$db="chumugu"; //DB名
try {
    $pdo =  new PDO('mysql:dbname='.$db.';charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
    exit('DB Connection Error:'.$e->getMessage());
}
//service_contentsテーブルのデータを取得する
$sql = "SELECT * FROM service_contents";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute(); //実行関数
if($status==false){
    $error = $stmt->errorInfo();
    exit("SQLError:".$error[2]);
}else{
    while($r = $stmt->fetch(PDO::FETCH_ASSOC)){
    $productList[] = array(
        'id' => $r['id']
    );
}
}

// ヘッダーを指定することによりjsonの動作を安定させる
header('Content-type: application/json');
// htmlへ渡す配列$productListをjsonに変換する
echo json_encode($productList);

