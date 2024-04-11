<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Git・PHP・SQL テスト課題</title>
</head>
<body>
    <section>
        <h2>錦夏未</h2>
        <div>
            <img src="zakoshi.avif" alt="Your Photo">
            <p>一番好きなお笑い芸人はハリウッドザコシショウです。</p>
        </div>
    </section>

    <section>
        <h2>お問い合わせフォーム</h2>
        <form action="process_form.php" method="post">
            <label for="name">名前:</label>
            <input type="text" id="name" name="name" required><br>
    
            <label for="email">メールアドレス:</label>
            <input type="email" id="email" name="email" required><br>
    
            <label for="message">メッセージ:</label><br>
            <textarea id="message" name="message" required></textarea><br>
    
            <input type="submit" value="送信">
        </form>
    </section>

    <section>
        <h2>今日もらったコメント</h2>
        <?php
// データベース接続情報
$servername = "localhost"; // データベースのホスト名
$username = "root"; // データベースのユーザー名
$password = ""; // データベースのパスワード
$dbname = "git_test"; // 使用するデータベース名

try {
    // PDOインスタンスを作成
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // エラーモードを例外に設定
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // コメントを取得するクエリ
    $sql = "SELECT * FROM comments";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // 結果を取得し表示
    if ($stmt->rowCount() > 0) {
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<p><strong>名前:</strong> " . $row["name"] . "<br>";
            echo "<strong>メールアドレス:</strong> " . $row["email"] . "<br>";
            echo "<strong>コメント:</strong> " . $row["message"] . "</p>";
        }
    } else {
        echo "コメントはありません";
    }
} catch(PDOException $e) {
    echo "エラー: " . $e->getMessage();
}

// データベース接続を閉じる
$conn = null;
?>

    </section> 
    
    
</body>
</html>