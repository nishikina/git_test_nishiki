<?php
// フォームから送信されたデータを受け取る
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$subject = $_POST['subject'];

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

    // SQLクエリを準備し、データを挿入する
    $sql = "INSERT INTO comments (name, email, message, subject) VALUES (:name, :email, :message, :subject)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':message', $message);
    $stmt->bindParam(':subject', $subject);
    $stmt->execute();

    // コメントが正常に挿入された場合にJavaScriptで確認ダイアログを表示
    echo "<script>
            if(confirm('コメントを送信しますか？')) {
                alert('コメントを送信しました。');
                window.location = 'index.php'; // リダイレクト先のページを指定する
            } else {
                window.history.back(); // 前のページに戻る
            }
          </script>";
} catch(PDOException $e) {
    echo "エラー: " . $e->getMessage();
}

// データベース接続を閉じる
$conn = null;
?>
