<?php include 'project.php';
$host = 'localhost';
$username = 'root';
$db = 'dictionary';
$password = '1234';
$word = $_GET["WORD"];
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;3
}
$sql = " SELECT word.word_id,word.syllable,word.pronunciation,word.example,word.image,word.partsofspeech,word.scientific_name,meaning.word_id,meaning.hindi,meaning.english,meaning.marathi,meaning.telugu,meaning.antonym,meaning.synonym from word JOIN meaning ON word.word_id=meaning.word_id where word='$word'";
try {
    $stmt = $pdo->query($sql);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Query failed: " . $e->getMessage();
    exit;
}
//Travserse the output recieved
foreach ($data as $row) {
    echo "Word: " . $row['word'] . "<br>";?>
    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']);?>" width=80 height=80/>
    <?php echo "<br>Meaning: " . $row['english'] . "<br>";

    echo "Synonym:" . $row['synonym'] . "," . $row['synonym'] . "<br>";
    echo "Antonym:" . $row['antonym'] . "," . $row['antonym'] . "<br>";
    echo "Part of Speech:" . $row['partsofspeech'] . "<br>";
    echo "Pronounciation:" . $row['pronunciation'] . "<br>";
    echo "Syllable:" . $row['syllable'] . "<br>";
    echo "Hindi:" . $row['hindi'] . "<br>";
    echo "Marathi:" . $row['marathi'] . "<br>";
    echo "Telugu:" . $row['telugu'] . "<br>";
    echo "Example:" . $row['example'] . "<br>";
    
    if (is_null($row['scientific_name']) == 0) {
        echo "Scientific Name:" . $row['scientific_name'] . "<br>";
    }
}
$pdo = null;
?>